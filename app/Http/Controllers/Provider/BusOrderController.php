<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\UpdateBusOrderRequest;
use App\Repositories\BusOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\BusDatetime;
use App\Models\Destination;
use App\Models\User;
use App\Models\Bus;
use App\Models\City;
use App\Models\BusOrder;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;
use DB;

class BusOrderController extends AppBaseController
{
    /** @var BusOrderRepository $busOrderRepository*/
    private $busOrderRepository;

    public function __construct(BusOrderRepository $busOrderRepo)
    {
        $this->busOrderRepository = $busOrderRepo;
        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the BusOrder.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $input['provider_id'] = $this->provider_id;
        $input['provider_archive'] = $request->archive ?? 0;

        if(Auth::guard('provider')->user()->role == 'driver' && is_null($request->bus_id)) {
            $input['bus_id'] = Auth::guard('provider')->user()->buses->pluck('id')->toArray();
        }

        $busOrders = $this->busOrderRepository->all($input);

        $destinations = Destination::where('provider_id', $this->provider_id)->get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $buses = Bus::where('provider_id', $this->provider_id)->pluck('plate', 'id');

        return view('provider.bus_orders.index')
            ->with('busOrders', $busOrders)
            ->with('destinations', $destinations)
            ->with('users', $users)
            ->with('buses', $buses);
    }

    /**
     * Show the form for creating a new BusOrder.
     *
     * @return Response
     */
    public function create()
    {
        $status = [
            'pending' => __('models/busOrders.status.pending'),
            'approved' => __('models/busOrders.status.approved'),
        ];

        $buses = Bus::where('provider_id', $this->provider_id)    
            ->where('active', 1)
            ->pluck('plate', 'id');

        $users = User::pluck('name', 'id');
        $cities = City::pluck('name', 'id');
        $tax = Auth::guard('provider')->user()->provider->tax;

        return view('provider.bus_orders.create')
            ->with('buses', $buses)
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('status', $status)
            ->with('tax', $tax);
    }

    /**
     * Store a newly created BusOrder in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, BusOrder::$provider_rules);

        $tax = Auth::guard('provider')->user()->provider->tax;
        
        DB::beginTransaction();

        $input = array_merge([
            'provider_id' => $this->provider_id,
            'fees'   => $fees = $request->fees,
            'tax' => $tax = ($fees * $tax / 100),
            'total' => $fees + $tax,
        ], $request->only(
            'user_id',
            'lat',
            'lng',
            'zoom',
            'date_from',
            'time_from',
            'date_to',
            'time_to',
            'destination',
            'bus_id',
            'user_notes',
            'status'
        ));

        // store busOrder
        $busOrder = $this->busOrderRepository->create($input);

        // store busOrder Datetimes (only if approved)
        if($busOrder->status == 'approved') {
            $date = Carbon::parse($busOrder->date_from);
            while ($date->lte(Carbon::parse($busOrder->date_to))) {
                BusDatetime::create([
                    'bus_order_id' => $busOrder->id,
                    'bus_id' => $busOrder->bus_id,
                    'date' => $date->format('Y-m-d'),
                    'time_from' => $busOrder->time_from,
                    'time_to' => $busOrder->time_to,
                ]);

                $date = $date->addDay();
            }
        }

        // send notification to the user
        $notification = Notification::create([
            'title' => 'Order #' . $busOrder->id,
            'text' => "Your order has been created successfully, 
                order is " . __('models/busOrders.status.'.$busOrder->status) . ", please click to check more details.",
            'url' => route('busOrders.show', $busOrder->id),
            'icon' => 'ti-truck',
            'type' => 'primary',
            'to' => 'user',
            'user_id' => $busOrder->user_id
        ]);

        DB::commit();
        
        Flash::success(__('messages.saved', ['model' => __('models/busOrders.singular')]));
        return redirect(route('provider.busOrders.index'));
    }

    /**
     * Display the specified BusOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Request $request)
    {
        $busOrder = $this->busOrderRepository->find($id);
        if (empty($busOrder) || $busOrder->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('provider.busOrders.index'));
        }

        $status = [];
        if($busOrder->status == 'pending') $status['pending'] = __('models/busOrders.status.pending');

        $status['approved'] = __('models/busOrders.status.approved');
        $status['rejected'] = __('models/busOrders.status.rejected');

        return view('provider.bus_orders.show')
            ->with('busOrder', $busOrder)
            ->with('status', $status);
    }

    /**
     * Update the specified BusOrder in storage.
     *
     * @param int $id
     * @param UpdateBusOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBusOrderRequest $request)
    {
        $busOrder = $this->busOrderRepository->find($id);
        if (empty($busOrder) || $busOrder->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('provider.busOrders.index'));
        }

        $input = $request->only('provider_notes');

        if(!in_array($busOrder->status, ['canceled', 'rejected', 'complete'])) {

            if($request->status != 'rejected' && isset($request->fees)) {
                $input['fees'] = $request->fees;
                $input['tax'] = $input['fees'] * (!is_null($provider = $busOrder->provider) ? $provider->tax : 0) / 100;
                $input['total'] = $input['fees'] + $input['tax'];
            }

            if(in_array($request->status, ['pending', 'approved', 'rejected'])
                && !($busOrder->status == 'paid' && $request->status == 'approved')) {

                    $input['status'] = $request->status;
                }
        }

        DB::beginTransaction();

        $status = $busOrder->status;

        $busOrder = $this->busOrderRepository->update($input, $id);

        if($status != $busOrder->status) {
            // store busOrder Datetimes (only if approved)
            if($busOrder->status == 'approved') {
                $date = Carbon::parse($busOrder->date_from);
                while ($date->lte(Carbon::parse($busOrder->date_to))) {
                    BusDatetime::create([
                        'bus_order_id' => $busOrder->id,
                        'bus_id' => $busOrder->bus_id,
                        'date' => $date->format('Y-m-d'),
                        'time_from' => $busOrder->time_from,
                        'time_to' => $busOrder->time_to,
                    ]);

                    $date = $date->addDay();
                }
            } elseif($busOrder->status == 'rejected') {
                if($status == 'paid') {
                    if($request->return == 'wallet' && !is_null($user = User::find($busOrder->user_id))) {
                        $wallet = $user->wallet + $busOrder->total;
                        $user->update(['wallet' => $wallet]);
                    } else {
                        // return money to user bank (depending on payment gateway)
                        // code ...
                    }
                }        
            }

            // send notification to the user
            $notification = Notification::create([
                'title' => 'Order #' . $busOrder->id,
                'text' => "Your order is " . __('models/busOrders.status.'.$busOrder->status) . 
                    ($busOrder->status == 'approved' ?  ", please do the payment to complete the order." : ", please click to check more details."),
                'url' => route('busOrders.show', $busOrder->id),
                'icon' => 'ti-' . ($busOrder->status == 'approved' ? 'check' : 'close'),
                'type' => ($busOrder->status == 'approved' ? 'success' : 'danger'),
                'to' => 'user',
                'user_id' => $busOrder->user_id
            ]);
        }

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/busOrders.singular')]));
        return redirect(route('provider.busOrders.index'));
    }

    /**
     * Remove the specified BusOrder from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $busOrder = $this->busOrderRepository->find($id);

        if (empty($busOrder) || $busOrder->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('provider.busOrders.index'));
        }

        $this->busOrderRepository->update(['provider_archive' => 1], $id);

        Flash::success(__('messages.deleted', ['model' => __('models/busOrders.singular')]));
        return redirect(route('provider.busOrders.index'));
    }
}
