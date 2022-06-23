<?php

namespace App\Http\Controllers\User;

use App\Repositories\TripOrderRepository;
use App\Http\Requests\CreateTripOrderRequest;
use App\Http\Requests\UpdateTripOrderRequest;
use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\User\cartController;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Notification;
use App\Models\Coupon;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;
use DB;
use Session;

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
        $tripOrders = $this->tripOrderRepository->all(['user_id' => $this->id]);

        return view('user.trip_orders.index')
            ->with('tripOrders', $tripOrders);
    }

    public function store(Request $request)
    {
        $type = $request->type;
        $message = __('messages.saved', ['model' => __('models/tripOrders.singular')]);

        $request->request->add(['user_id' => $this->id]);

        if($type == 'one-way') {
            $input = cartController::buildTheRequest($request);
            $response = $this->saveTripOrder($input);
            $response = $response->getData();
            if(!$response->success) {
                Flash::error($response->message);
                return redirect()->back()->withInput();
            }

            $tripOrder = $response->tripOrder;

            $request->session()->flash('payment', $message . ', ' . __('msg.please_do_the_payment_and_complete_the_order'));
            return redirect()->route('tripOrders.payment', ['id' => $tripOrder->id]);
        }

        // Add To Cart (Trip type is round or multi)
        if(cartController::add($request)) {
            $cart = Session::get('cart');
            if($type == 'round') {
                if(count($cart) > 1) {
                    $request->session()->flash('flash_cart', $message . ', ' . __('msg.please_do_the_payment_and_complete_the_order'));
                    return redirect()->route('cart');
                }
                $request->session()->flash('trip', $message . ', ' . __('msg.choose_your_next_trip'));
                return redirect()->route('trips.index', [
                    'from_city_id' => $request->to_city_id,
                    'to_city_id' => $request->from_city_id,
                    'date_from' => $request->date_to ?? $request->date_from,
                    'type' => $type
                ]);
            } elseif($type == 'multi'
                && isset($request->destination)
                && is_array($destination = $request->destination)
                && isset($destination['from_city_id'])) {

                    if(count($cart) >= count($destination['from_city_id'])) {
                        $request->session()->flash('flash_cart', $message . ', ' . __('msg.please_do_the_payment_and_complete_the_order'));
                        return redirect()->route('cart');
                    }
                    $request->session()->flash('trip', $message . ', ' . __('msg.choose_your_next_trip'));
                    return redirect()->route('trips.index', [
                        'destination' => $request->destination,
                        'type' => $type
                    ]);
            }
        }

        $request->session()->flash('cart', $message . ', ' . __('msg.please_do_the_payment_and_complete_the_order'));
        return redirect()->route('cart');
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

    public function saveTripOrder($input)
    {
        DB::beginTransaction();

        $tripOrder = $this->tripOrderRepository->create($input);
        $trip = $tripOrder->trip;

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
        // if($tripOrder->status == 'approved') {
        $apiRequest = new CreateTicketAPIRequest;
        $apiRequest->replace(['type' => 'trip', 'trip_order_id' => $tripOrder->id]);
        $storeTickets = app('App\Http\Controllers\API\TicketAPIController')->store($apiRequest);
        $response     = $storeTickets->getData();

        if(!$response->success) {
            DB::rollback();
            return $response;
        }

        DB::commit();
        return response()->json(['success' => true, 'tripOrder' => $tripOrder]);
        // }
    }
}
