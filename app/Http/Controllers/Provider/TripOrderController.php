<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Requests\UpdateTripOrderRequest;
use App\Repositories\TripOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\TripOrder;
use App\Models\Notification;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Trip;
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
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
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
        $tripOrders = $this->tripOrderRepository->all(array_merge($request->all(), ['provider_id' => $this->provider_id]));

        $users = User::pluck('name', 'id');
        $coupons = Coupon::where('provider_id', $this->provider_id)->pluck('name', 'id');
        $trips = Trip::where('provider_id', $this->provider_id)->pluck('id', 'id');

        return view('provider.trip_orders.index')
            ->with('tripOrders', $tripOrders)
            ->with('users', $users)
            ->with('coupons', $coupons)
            ->with('trips', $trips);
    }

    /**
     * Show the form for creating a new TripOrder.
     *
     * @return Response
     */
    public function create()
    {
        $status = [
            'pending' => __('models/tripOrders.status.pending'),
            'approved' => __('models/tripOrders.status.approved'),
        ];

        $today = Carbon::now()->format('Y-m-d');

        $trips = Trip::where('provider_id', $this->provider_id)    
            // ->where('date_from', '<=', $today)
            ->where('date_to', '>=', $today)
            ->pluck('id', 'id');
        $users = User::pluck('name', 'id');
        $coupons = Coupon::where('provider_id', $this->provider_id)
            ->where('date_from', '<=', $today)
            ->where('date_to', '>=', $today)
            ->pluck('name', 'id');

        return view('provider.trip_orders.create')
            ->with('status', $status)
            ->with('trips', $trips)
            ->with('users', $users)
            ->with('coupons', $coupons);
    }

    /**
     * Store a newly created Bus in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, TripOrder::$provider_rules);

        $trip = Trip::find($request->trip_id);

        DB::beginTransaction();

        $input = $request->all();
        $input['provider_id'] = $this->provider_id;

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

        $input = array_merge($request->only('trip_id', 'user_id', 'coupon_id', 'count', 'type', 'status'), [
            'provider_id' => $this->provider_id,
            'fees' => $fees = $trip->fees * $request->count,
            'tax' => $tax = ($fees * (!is_null($provider = $trip->provider) ? $provider->tax : 0) / 100),
            'total' => is_null($coupon = Coupon::find($request->coupon_id))
                ? $fees + $tax + $additionalFees 
                : ($total = $fees + $tax + $additionalFees) - ($coupon->type == 'amount' ? $coupon->discount : ($total * $coupon->discount / 100)),
            'additional' => json_decode(json_encode($additional))
        ]);

        $tripOrder = $this->tripOrderRepository->create($input);

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

        Flash::success(__('messages.saved', ['model' => __('models/tripOrders.singular')]));
        return redirect(route('provider.tripOrders.index'));
    }
    
    /**
     * Display the specified TripOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tripOrder = $this->tripOrderRepository->find($id);
        if (empty($tripOrder) || $tripOrder->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('provider.tripOrders.index'));
        }

        $status = [];
        if($tripOrder->status == 'pending') $status['pending'] = __('models/tripOrders.status.pending');

        $status['approved'] = __('models/tripOrders.status.approved');
        $status['rejected'] = __('models/tripOrders.status.rejected');

        return view('provider.trip_orders.show')
            ->with('tripOrder', $tripOrder)
            ->with('status', $status);
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
        if (empty($tripOrder) || $tripOrder->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('provider.tripOrders.index'));
        }

        $input = $request->only('provider_notes');

        if(!in_array($tripOrder->status, ['canceled', 'rejected']) 
                && in_array($request->status, ['pending', 'approved', 'rejected'])
                && !($tripOrder->status == 'paid' && $request->status == 'approved')) {

            $input['status'] = $request->status;
            // $input['seat_num'] = $request->seat_num;
        }

        DB::beginTransaction();

        $status = $tripOrder->status;

        $tripOrder = $this->tripOrderRepository->update($input, $id);

        if($status != $tripOrder->status) {
            // store order Tickets (only if approved)
            if($tripOrder->status == 'approved') {
                $ticketRequest = new CreateTicketAPIRequest;
                $ticketRequest->replace(['type' => 'trip', 'trip_order_id' => $id]);
                $storeTickets = app('App\Http\Controllers\API\TicketAPIController')->store($ticketRequest);
                $response     = $storeTickets->getData();
                if(!$response->success) {
                    Flash::error($response->message);
                    return redirect()->back()->withInput();
                }
            } elseif($tripOrder->status == 'rejected') {
                if($status == 'paid') {
                    if($request->return == 'wallet' && !is_null($user = User::find($tripOrder->user_id))) {
                        $wallet = $user->wallet + $tripOrder->total;
                        $user->update(['wallet' => $wallet]);
                    } else {
                        // return money to user bank (depending on payment gateway)
                        // code ...
                    }
                }
        
                Ticket::where('trip_order_id', $id)->delete();
            }

            // send notification to the user
            $notification = Notification::create([
                'title' => 'Trip Order #' . $id,
                'text' => "Your order is " . __('models/trips.status.'.$tripOrder->status) . 
                    ($tripOrder->status == 'approved' ?  ", please do the payment to complete the order." : ", please click to check more details."),
                'url' => route('trips.show', $tripOrder->id),
                'icon' => 'ti-' . ($tripOrder->status == 'approved' ? 'check' : 'close'),
                'type' => ($tripOrder->status == 'approved' ? 'success' : 'danger'),
                'to' => 'user',
                'user_id' => $tripOrder->user_id
            ]);
        }

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/tripOrders.singular')]));
        return redirect(route('provider.tripOrders.index'));
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

        if (empty($tripOrder) || $tripOrder->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('provider.tripOrders.index'));
        }

        $this->tripOrderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tripOrders.singular')]));
        return redirect(route('provider.tripOrders.index'));
    }
}
