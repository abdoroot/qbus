<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Requests\UpdatePackageOrderRequest;
use App\Repositories\PackageOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Ticket;
use App\Models\PackageOrder;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;
use DB;

class PackageOrderController extends AppBaseController
{
    /** @var PackageOrderRepository $packageOrderRepository*/
    private $packageOrderRepository;

    public function __construct(PackageOrderRepository $packageOrderRepo)
    {
        $this->packageOrderRepository = $packageOrderRepo;
        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the PackageOrder.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $packageOrders = $this->packageOrderRepository->all(array_merge($request->all(), ['provider_id' => $this->provider_id]));

        $users = User::pluck('name', 'id');
        $coupons = Coupon::where('provider_id', $this->provider_id)->pluck('name', 'id');
        $packages = Package::where('provider_id', $this->provider_id)->pluck('name', 'id');

        return view('provider.package_orders.index')
            ->with('packageOrders', $packageOrders)
            ->with('users', $users)
            ->with('coupons', $coupons)
            ->with('packages', $packages);
    }

    /**
     * Show the form for creating a new PackageOrder.
     *
     * @return Response
     */
    public function create()
    {
        $status = [
            'pending' => __('models/packageOrders.status.pending'),
            'approved' => __('models/packageOrders.status.approved'),
        ];

        $packages = Package::where('provider_id', $this->provider_id)->pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $coupons = Coupon::where('provider_id', $this->provider_id)
            ->where('date_from', '<=', $today = Carbon::now()->format('Y-m-d'))
            ->where('date_to', '>=', $today)
            ->pluck('name', 'id');

        return view('provider.package_orders.create')
            ->with('status', $status)
            ->with('packages', $packages)
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
        $this->validate($request, PackageOrder::$provider_rules);

        $package = Package::find($request->package_id);

        DB::beginTransaction();

        $input = $request->all();
        $input['provider_id'] = $this->provider_id;

        $input = array_merge($request->only('package_id', 'user_id', 'coupon_id', 'count', 'type', 'status'), [
            'provider_id' => $this->provider_id,
            'fees' => $fees = ($package->fees * $request->count),
            'tax' => $tax = ($fees * (!is_null($provider = $package->provider) ? $provider->tax : 0) / 100),
            'total' => is_null($coupon = Coupon::find($request->coupon_id))
                ? $fees + $tax 
                : ($total = $fees + $tax) - ($coupon->type == 'amount' ? $coupon->discount : ($total * $coupon->discount / 100)),
        ]);

        $packageOrder = $this->packageOrderRepository->create($input);

        // Notify User
        $userNotif = Notification::create([
            'title' => 'Package Order #' . $packageOrder->id,
            'text' => "Your order is created successfully for package #{$package->id} {$package->name}, please click to check more details.",
            'url' => route('packageOrders.show', $packageOrder->id),
            'icon' => 'ti-shopping-cart',
            'type' => 'info',
            'to' => 'user',
            'user_id' => $packageOrder->user_id
        ]);

        // store order Tickets (only if approved)
        if($packageOrder->status == 'approved') {
            $apiRequest = new CreateTicketAPIRequest;
            $apiRequest->replace(['type' => 'package', 'package_order_id' => $packageOrder->id]);
            $storeTickets = app('App\Http\Controllers\API\TicketAPIController')->store($apiRequest);
            $response     = $storeTickets->getData();
            if(!$response->success) {
                Flash::error($response->message);
                return redirect()->back()->withInput();
            }
        }

        DB::commit();

        Flash::success(__('messages.saved', ['model' => __('models/packageOrders.singular')]));
        return redirect(route('provider.packageOrders.index'));
    }
    
    /**
     * Display the specified PackageOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $packageOrder = $this->packageOrderRepository->find($id);
        if (empty($packageOrder) || $packageOrder->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('provider.packageOrders.index'));
        }

        $status = [];
        if($packageOrder->status == 'pending') $status['pending'] = __('models/packageOrders.status.pending');

        $status['approved'] = __('models/packageOrders.status.approved');
        $status['rejected'] = __('models/packageOrders.status.rejected');

        return view('provider.package_orders.show')
            ->with('packageOrder', $packageOrder)
            ->with('status', $status);
    }

    /**
     * Update the specified PackageOrder in storage.
     *
     * @param int $id
     * @param UpdatePackageOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackageOrderRequest $request)
    {
        $packageOrder = $this->packageOrderRepository->find($id);
        if (empty($packageOrder) || $packageOrder->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('provider.packageOrders.index'));
        }

        $input = $request->only('provider_notes');

        if(!in_array($packageOrder->status, ['canceled', 'rejected']) 
                && in_array($request->status, ['pending', 'approved', 'rejected'])
                && !($packageOrder->status == 'paid' && $request->status == 'approved')) {

            $input['status'] = $request->status;
        }

        DB::beginTransaction();

        $status = $packageOrder->status;

        $packageOrder = $this->packageOrderRepository->update($input, $id);

        if($status != $packageOrder->status) {
            // store order Tickets (only if approved)
            if($packageOrder->status == 'approved') {
                $request = new CreateTicketAPIRequest;
                $request->replace(['type' => 'package', 'package_order_id' => $id]);
                $storeTickets = app('App\Http\Controllers\API\TicketAPIController')->store($request);
                $response     = $storeTickets->getData();
                if(!$response->success) {
                    Flash::error($response->message);
                    return redirect()->back()->withInput();
                }
            } elseif($packageOrder->status == 'rejected') {
                if($status == 'paid') {
                    if($request->return == 'wallet' && !is_null($user = User::find($packageOrder->user_id))) {
                        $wallet = $user->wallet + $packageOrder->total;
                        $user->update(['wallet' => $wallet]);
                    } else {
                        // return money to user bank (depending on payment gateway)
                        // code ...
                    }
                }
        
                Ticket::where('package_order_id', $id)->delete();
            }

            // send notification to the user
            $notification = Notification::create([
                'title' => 'Package Order #' . $id,
                'text' => "Your order is " . __('models/packages.status.'.$packageOrder->status) . 
                    ($packageOrder->status == 'approved' ?  ", please do the payment to complete the order." : ", please click to check more details."),
                'url' => route('packageOrders.show', $packageOrder->id),
                'icon' => 'ti-' . ($packageOrder->status == 'approved' ? 'check' : 'close'),
                'type' => ($packageOrder->status == 'approved' ? 'success' : 'danger'),
                'to' => 'user',
                'user_id' => $packageOrder->user_id
            ]);
        }

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/packageOrders.singular')]));
        return redirect(route('provider.packageOrders.index'));
    }

    /**
     * Remove the specified PackageOrder from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $packageOrder = $this->packageOrderRepository->find($id);

        if (empty($packageOrder) || $packageOrder->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('provider.packageOrders.index'));
        }

        $this->packageOrderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/packageOrders.singular')]));
        return redirect(route('provider.packageOrders.index'));
    }
}
