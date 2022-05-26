<?php

namespace App\Http\Controllers\User;

use App\Repositories\TripOrderRepository;
use App\Http\Requests\CreateTripOrderRequest;
use App\Http\Requests\UpdateTripOrderRequest;
use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Notification;
use App\Models\Coupon;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;
use DB;

class TripOrderController extends AppBaseController
{
    /** @var TripOrderRepository $tripOrderRepository*/
    private $tripOrderRepository;

    public function __construct(TripOrderRepository $tripOrderRepo)
    {
        $this->tripOrderRepository = $tripOrderRepo;
        $this->middleware(function ($request, $next) {
            $this->id = Auth::check() ? Auth::user()->id : null;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the TripOrder.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $trips = $this->tripOrderRepository->all(['user_id' => $this->id]);

        return view('user.trip_orders.index')
            ->with('trips', $trips);
    }

    public function store(Request $request)
    {
        $trip = Trip::find($request->trip_id);

        DB::beginTransaction();

        $coupon = Coupon::where([
                'code' => $request->code,
                'provider_id' => $trip->provider_id,
                'status' => 'approved',
            ])
            ->where('date_from', '<=', $today = Carbon::now()->toDateString())
            ->where('date_to', '>=', $today)
            ->first();

        $additionalFees = 0;
        $additional = [];
        $tripAdditional = $trip->additional;

        foreach ($request->additional ?? [] as $additional_id) {
            $filter = array_filter($tripAdditional, function ($addition) use ($additional_id)
            {
                return $addition['id'] == $additional_id;
            });

            if(is_null($filter)) continue;

            $filter = array_shift($filter);
            $count = (isset($request->additional_count[$filter['id']]) ? $request->additional_count[$filter['id']] : 1);
            $additionFees = $filter['fees'] * $count;

            $additional[] = ['id' => $additional_id, 'fees' => $additionFees, 'count' => $count];
            $additionalFees += $additionFees;
        }

        $input = array_merge($request->only('trip_id', 'count', 'user_notes', 'type', 'prev_trip_order_id'), [
            'user_id' => $this->id,
            'provider_id' => $trip->provider_id,
            'fees' => $fees = $trip->fees * $request->count,
            'tax' => $tax = ($fees * (!is_null($provider = $trip->provider) ? $provider->tax : 0) / 100),
            'coupon_id' => !is_null($coupon) ? $coupon->id : null,
            'total' => is_null($coupon)
                ? $fees + $tax + $additionalFees 
                : ($total = $fees + $tax + $additionalFees) - ($coupon->type == 'amount' ? $coupon->discount : ($total * $coupon->discount / 100)),
            'status' => $trip->auto_approve ? 'approved' : 'pending',
            'additional' => json_decode(json_encode($additional))
        ]);

        $tripOrder = $this->tripOrderRepository->create($input);

        // Notify Provider
        $providerNotif = Notification::create([
            'title' => 'Trip Order #' . $tripOrder->id,
            'text' => "New reservation for trip #{$trip->id}, please click to check more details.",
            'url' => route('provider.tripOrders.show', $tripOrder->id),
            'icon' => 'ti-shopping-cart',
            'type' => ($tripOrder->status == 'pending' ? 'warning' : 'info'),
            'to' => 'provider',
            'provider_id' => $tripOrder->provider_id
        ]);

        // Notify User
        $userNotif = Notification::create([
            'title' => 'Trip Order #' . $tripOrder->id,
            'text' => "Your order is created successfully for trip #{$trip->id}, please click to check more details.",
            'url' => route('tripOrders.show', $tripOrder->id),
            'icon' => 'ti-shopping-cart',
            'type' => 'info',
            'to' => 'user',
            'user_id' => $tripOrder->user_id
        ]);

        // store order Tickets (only if approved)
        if($tripOrder->status == 'approved') {
            $apiRequest = new CreateTicketAPIRequest;
            $apiRequest->replace(['type' => 'trip', 'trip_order_id' => $tripOrder->id]);
            $storeTickets = app('App\Http\Controllers\API\TicketAPIController')->store($apiRequest);
            $response     = $storeTickets->getData();
            if(!$response->success) {
                Flash::error($response->message);
                return redirect()->back()->withInput();
            }
        }

        DB::commit();

        $message = __('messages.saved', ['model' => __('models/tripOrders.singular')]);

        $type = $tripOrder->type;
        
        if($tripOrder->status == 'approved') {

            $message .= ', ' . __('msg.please_do_the_payment_and_complete_the_order');
            $request->session()->flash('payment', $message);
            $data = ['id' => $tripOrder->id];
            if($type == 'round' && is_null($request->prev_trip_order_id)) {
                $data = array_merge($data, [
                    'prev_trip_order_id' => $tripOrder->id,
                    'from_city_id' => $request->to_city_id,
                    'to_city_id' => $request->from_city_id,
                    'date_from' => $request->date_to ?? $request->date_from,
                    'type' => $request->type
                ]);
            } elseif($type == 'multi'
                && isset($request->destination) 
                && is_array($destination = $request->destination)) {
                    $data = array_merge($data, [
                        'prev_trip_order_id' => $tripOrder->id,
                        'destination' => $request->destination,
                        'type' => $request->type
                    ]);
            }

            return redirect()->route('tripOrders.payment', $data);

        } elseif($type == 'round' && is_null($request->prev_trip_order_id)) {

            $message .= ', ' . __('msg.choose_your_next_trip');
            $request->session()->flash('trip', $message);
            return redirect()->route('trips.index', [
                'prev_trip_order_id' => $tripOrder->id,
                'from_city_id' => $request->to_city_id,
                'to_city_id' => $request->from_city_id,
                'date_from' => $request->date_to ?? $request->date_from,
                'type' => $request->type
            ]);

        } elseif($type == 'multi' 
            && isset($request->destination) 
            && is_array($destination = $request->destination)
            && isset($destination['from_city_id'])
            && $tripOrder->nextMultiIndex() < count($destination['from_city_id']) - 1) {

                $message .= ', ' . __('msg.choose_your_next_trip');
                $request->session()->flash('trip', $message);
                return redirect()->route('trips.index', [
                    'prev_trip_order_id' => $tripOrder->id,
                    'destination' => $request->destination,
                    'type' => $request->type
                ]);
        }

        $message .= ', ' . __('msg.please_wait_for_provider_approval_to_do_the_payment_and_complete_the_order');
        $request->session()->flash('trip', $message);
        return redirect()->back();
    }

    /**
     * Display the specified TripOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Request $request)
    {
        $tripOrder = $this->tripOrderRepository->find($id);
        if (empty($tripOrder) || $tripOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('tripOrders.index'));
        }

        return view('user.trip_orders.show')
            ->with('tripOrder', $tripOrder)
            ->with('active', $request->active);
    }

    /**
     * Update the specified TripOrder in storage.
     *
     * @param int $id
     * @param UpdateTripOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTripOrderRequest $request)
    {
        $tripOrder = $this->tripOrderRepository->find($id);

        if (empty($tripOrder) || $tripOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('tripOrders.index'));
        }

        if (!in_array($tripOrder->status, ['pending', 'approved'])) {
            Flash::error(__('msg.unauthorized'));
            return redirect(route('tripOrders.index'));
        }

        DB::beginTransaction();

        if(is_null($user_notes = $request->user_notes)) {
            return redirect()->back()->withErrors([
                'user_notes' => __('validation.required', ['attribute' => __('models/tripOrders.fields.user_notes')])
            ]);
        }

        $input = [
            'status' => 'canceled',
            'user_notes' => $user_notes
        ];

        $tripOrder = $this->tripOrderRepository->update($input, $id);

        // send notification to the user
        $notification = Notification::create([
            'title' => 'Order #' . $tripOrder->id,
            'text' => "The order is " . __('models/tripOrders.status.'.$tripOrder->status) .  ", please click to check more details.",
            'url' => route('provider.tripOrders.show', $tripOrder->id),
            'icon' => 'ti-close',
            'type' => 'danger',
            'to' => 'provider',
            'provider_id' => $tripOrder->provider_id
        ]);

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/tripOrders.singular')]));
        return redirect(route('tripOrders.index'));
    }

    /**
     * Remove the specified TripOrder from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tripOrder = $this->tripOrderRepository->find($id);

        if (empty($tripOrder) || $tripOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('tripOrders.index'));
        }

        $this->tripOrderRepository->update(['user_archive' => 1], $id);

        Flash::success(__('messages.deleted', ['model' => __('models/tripOrders.singular')]));
        return redirect(route('tripOrders.index'));
    }

    public function payment($id, Request $request)
    {
        $tripOrder = $this->tripOrderRepository->find($id);
        if (empty($tripOrder) || $tripOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('tripOrders.index'));
        }
        if($tripOrder->status != 'approved') {
            Flash::error(__('msg.the_payment_link_is_not_valid'));
            return redirect(route('tripOrders.index'));
        }

        return('redirect to the payment gateway ...');
    }
}
