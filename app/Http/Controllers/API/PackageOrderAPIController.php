<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePackageOrderAPIRequest;
use App\Http\Requests\API\UpdatePackageOrderAPIRequest;
use App\Models\PackageOrder;
use App\Repositories\PackageOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Package;
use App\Models\Notification;
use App\Models\Coupon;
use Carbon\Carbon;
use Flash;
use Auth;
use DB;
/**
 * Class PackageOrderController
 * @package App\Http\Controllers\API
 */

class PackageOrderAPIController extends AppBaseController
{
    /** @var  PackageOrderRepository */
    private $packageOrderRepository;

    public function __construct(PackageOrderRepository $packageOrderRepo)
    {
        $this->packageOrderRepository = $packageOrderRepo;
    }

    /**
     * Display a listing of the PackageOrder.
     * GET|HEAD /packageOrders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $packageOrders = $this->packageOrderRepository->all(
            array_merge(['user_id' => $user->id], $request->except(['skip', 'limit'])),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $packageOrders->toArray(),
            __('messages.retrieved', ['model' => __('models/packageOrders.plural')])
        );
    }

    /**
     * Store a newly created PackageOrder in storage.
     * POST /packageOrders
     *
     * @param CreatePackageOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePackageOrderAPIRequest $request)
    {
        $user = Auth::user();

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
            'user_id' => $user->id,
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
                return $this->sendError($response->message);
            }
        }

        DB::commit();

        return $this->sendResponse(
            $packageOrder->toArray(),
            __('messages.saved', ['model' => __('models/packageOrders.singular')])
        );
    }

    /**
     * Display the specified PackageOrder.
     * GET|HEAD /packageOrders/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();

        /** @var PackageOrder $packageOrder */
        $packageOrder = $this->packageOrderRepository->find($id);

        if (empty($packageOrder) || $packageOrder->user_id != $user->id) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packageOrders.singular')])
            );
        }

        $packageOrder->additionals = $packageOrder->additionals();
        $packageOrder->package = $packageOrder->package;
        $packageOrder->packageDestinations = (!is_null($packageOrder->package) ? $packageOrder->package->packageDestinations() : []);
        
        return $this->sendResponse(
            $packageOrder->toArray(),
            __('messages.retrieved', ['model' => __('models/packageOrders.singular')])
        );
    }

    /**
     * Update the specified PackageOrder in storage.
     * PUT/PATCH /packageOrders/{id}
     *
     * @param int $id
     * @param UpdatePackageOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackageOrderAPIRequest $request)
    {
        $user = Auth::user();

        $packageOrder = $this->packageOrderRepository->find($id);

        if (empty($packageOrder) || $packageOrder->user_id != $user->id) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packageOrders.singular')])
            );
        }

        if (!in_array($packageOrder->status, ['pending', 'approved'])) {
            return $this->sendError(__('msg.unauthorized'));
        }

        DB::beginTransaction();

        if(is_null($user_notes = $request->user_notes)) {
            return $this->sendError(__('validation.required', ['attribute' => __('models/packageOrders.fields.user_notes')]));
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

        return $this->sendResponse(
            $packageOrder->toArray(),
            __('messages.updated', ['model' => __('models/packageOrders.singular')])
        );
    }

    /**
     * Remove the specified PackageOrder from storage.
     * DELETE /packageOrders/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        /** @var PackageOrder $packageOrder */
        $packageOrder = $this->packageOrderRepository->find($id);

        if (empty($packageOrder) || $user->id != $packageOrder->user_id) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packageOrders.singular')])
            );
        }

        $this->packageOrderRepository->update(['user_archive' => 1], $id);

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/packageOrders.singular')])
        );
    }
}
