<?php

namespace App\Http\Controllers\User;

use App\Repositories\PackageOrderRepository;
use App\Http\Requests\CreatePackageOrderRequest;
use App\Http\Requests\UpdatePackageOrderRequest;
use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Notification;
use App\Models\Coupon;
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
            $this->id = Auth::check() ? Auth::user()->id : null;    
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
        $packageOrders = $this->packageOrderRepository->all(['user_id' => $this->id])->paginate(10);

        return view('user.package_orders.index')
            ->with('packageOrders', $packageOrders);
    }

    public function store(CreatePackageOrderRequest $request)
    {
        $package = Package::find($request->package_id);

        DB::beginTransaction();

        $coupon = Coupon::where([
                'code' => $request->code,
                'provider_id' => $package->provider_id,
                'status' => 'approved',
            ])
            ->where('date_from', '<=', $today = Carbon::now()->toDateString())
            ->where('date_to', '>=', $today)
            ->first();

        $additionalFees = 0;
        $additional = [];
        $packageAdditional = $package->additional;

        foreach ($request->additional ?? [] as $additional_id) {
            $filter = array_filter($packageAdditional, function ($addition) use ($additional_id)
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

        $input = array_merge($request->only('package_id', 'count', 'user_notes'), [
            'user_id' => $this->id,
            'provider_id' => $package->provider_id,
            'fees' => $fees = $package->fees * $request->count,
            'tax' => $tax = ($fees * (!is_null($provider = $package->provider) ? $provider->tax : 0) / 100),
            'coupon_id' => !is_null($coupon) ? $coupon->id : null,
            'total' => is_null($coupon)
                ? $fees + $tax + $additionalFees 
                : ($total = $fees + $tax + $additionalFees) - ($coupon->type == 'amount' ? $coupon->discount : ($total * $coupon->discount / 100)),
            'status' => $package->auto_approve ? 'approved' : 'pending',
            'additional' => json_decode(json_encode($additional))
        ]);

        $packageOrder = $this->packageOrderRepository->create($input);

        // Notify Provider
        $providerNotif = Notification::create([
            'title' => 'Package Order #' . $packageOrder->id,
            'text' => "New reservation for package #{$package->id}, please click to check more details.",
            'url' => route('provider.packageOrders.show', $packageOrder->id),
            'icon' => 'ti-shopping-cart',
            'type' => ($packageOrder->status == 'pending' ? 'warning' : 'info'),
            'to' => 'provider',
            'provider_id' => $packageOrder->provider_id
        ]);

        // Notify User
        $userNotif = Notification::create([
            'title' => 'Package Order #' . $packageOrder->id,
            'text' => "Your order is created successfully for package #{$package->id}, please click to check more details.",
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

        $message = __('messages.saved', ['model' => __('models/packageOrders.singular')]);

        if($packageOrder->status == 'approved') {
            $message .= ', ' . __('msg.please_do_the_payment_and_complete_the_order');
            $request->session()->flash('payment', $message);
            return redirect()->route('packageOrders.payment', $packageOrder->id);
        }

        $message .= ', ' . __('msg.please_wait_for_provider_approval_to_do_the_payment_and_complete_the_order');
        $request->session()->flash('package', $message);
        
        return redirect()->back();
    }

    /**
     * Display the specified PackageOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Request $request)
    {
        $packageOrder = $this->packageOrderRepository->find($id);
        if (empty($packageOrder) || $packageOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('packageOrders.index'));
        }

        return view('user.package_orders.show')
            ->with('packageOrder', $packageOrder)
            ->with('active', $request->active);
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

        if (empty($packageOrder) || $packageOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('packageOrders.index'));
        }

        if (!in_array($packageOrder->status, ['pending', 'approved'])) {
            Flash::error(__('msg.unauthorized'));
            return redirect(route('packageOrders.index'));
        }

        DB::beginTransaction();

        if(is_null($user_notes = $request->user_notes)) {
            return redirect()->back()->withErrors([
                'user_notes' => __('validation.required', ['attribute' => __('models/packageOrders.fields.user_notes')])
            ]);
        }

        $input = [
            'status' => 'canceled',
            'user_notes' => $user_notes
        ];

        $packageOrder = $this->packageOrderRepository->update($input, $id);

        // send notification to the user
        $notification = Notification::create([
            'title' => 'Order #' . $packageOrder->id,
            'text' => "The order is " . __('models/packageOrders.status.'.$packageOrder->status) .  ", please click to check more details.",
            'url' => route('provider.packageOrders.show', $packageOrder->id),
            'icon' => 'ti-close',
            'type' => 'danger',
            'to' => 'provider',
            'provider_id' => $packageOrder->provider_id
        ]);

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/packageOrders.singular')]));
        return redirect(route('packageOrders.index'));
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

        if (empty($packageOrder) || $packageOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('packageOrders.index'));
        }

        $this->packageOrderRepository->update(['user_archive' => 1], $id);

        Flash::success(__('messages.deleted', ['model' => __('models/packageOrders.singular')]));
        return redirect(route('packageOrders.index'));
    }

    public function payment($id, Request $request)
    {
        $packageOrder = $this->packageOrderRepository->find($id);
        if (empty($packageOrder) || $packageOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('packageOrders.index'));
        }
        if($packageOrder->status != 'approved') {
            Flash::error(__('msg.the_payment_link_is_not_valid'));
            return redirect(route('packageOrders.index'));
        }

        return('redirect to the payment gateway ...');
    }
}
