<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePackageOrderRequest;
use App\Http\Requests\UpdatePackageOrderRequest;
use App\Repositories\PackageOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Package;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Notification;
use App\Models\PackageOrder;
use Flash;
use Response;
use DB;

class PackageOrderController extends AppBaseController
{
    /** @var PackageOrderRepository $packageOrderRepository*/
    private $packageOrderRepository;

    public function __construct(PackageOrderRepository $packageOrderRepo)
    {
        $this->packageOrderRepository = $packageOrderRepo;
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
        $packageOrders = $this->packageOrderRepository->all($request->all());

        $providers = Provider::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $coupons = Coupon::pluck('name', 'id');
        $packages = Package::pluck('name', 'id');

        return view('admin.package_orders.index')
            ->with('packageOrders', $packageOrders)
            ->with('providers', $providers)
            ->with('users', $users)
            ->with('coupons', $coupons)
            ->with('packages', $packages);
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

        if (empty($packageOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('admin.packageOrders.index'));
        }

        return view('admin.package_orders.show')->with('packageOrder', $packageOrder);
    }
    
    /**
     * Update the specified PackageOrder in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $packageOrder = $this->packageOrderRepository->find($id);
        if (empty($packageOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('admin.packageOrders.index'));
        }

        $rules = PackageOrder::$admin_rules;
        if($packageOrder->status == 'paid') $rules['return'] = 'required|in:bank,wallet';
        $this->validate($request, $rules);

        if (in_array($packageOrder->status, ['canceled', 'rejected'])) {
            Flash::error(__('msg.order_is_already') . __('models/packageOrders.status.'.$packageOrder->status));
            return redirect()->back();
        }

        DB::beginTransaction();

        $input = $request->only('admin_notes');
        $input['status'] = 'rejected';

        if($packageOrder->status == 'paid') {
            if($request->return == 'wallet' && !is_null($user = User::find($packageOrder->user_id))) {
                $wallet = $user->wallet + $packageOrder->total;
                $user->update(['wallet' => $wallet]);
            } else {
                // return money to user bank (depending on payment gateway)
                // code ...
            }
        }

        Ticket::where('package_order_id', $id)->delete();

        $packageOrder = $this->packageOrderRepository->update($input, $id);

        Notification::create([
            'title' => __('models/packageOrders.singular') . '#'. $packageOrder->id,
            'text' => $packageOrder->admin_notes,
            'url' => route('packageOrders.show', $packageOrder->id),
            'icon' => 'icon-info',
            'type' => 'danger',
            'to' => 'user',
            'user_id' => $packageOrder->user_id,
        ]);

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/packageOrders.singular')]));
        return redirect(route('admin.packageOrders.index'));
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

        if (empty($packageOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/packageOrders.singular')]));
            return redirect(route('admin.packageOrders.index'));
        }

        $this->packageOrderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/packageOrders.singular')]));
        return redirect(route('admin.packageOrders.index'));
    }
}
