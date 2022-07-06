<?php

namespace App\Http\Controllers\User;

use App\Repositories\PackageOrderRepository;
use App\Http\Requests\API\CreatePackageOrderAPIRequest;
use App\Http\Requests\API\UpdatePackageOrderAPIRequest;
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
use Session;

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
        $packageOrders = $this->packageOrderRepository->all([
            'user_id' => $this->id,
            'user_archive' => 0
            ])->paginate(10);

        return view('user.package_orders.index')
            ->with('packageOrders', $packageOrders);
    }

    public function store(CreatePackageOrderAPIRequest $request)
    {
        $request = app('App\Http\Controllers\API\PackageOrderAPIController')->store($request);
        $response = $request->getData();
        if(!$response->success) {
            Flash::error($response->message);
            return redirect()->back();
        }

        $message = $response->message;
        $packageOrder = $response->data;

        if($packageOrder->status == 'approved') {
            $message .= ', ' . __('msg.please_do_the_payment_and_complete_the_order');
            Session::flash('payment', $message);
            return redirect()->route('packageOrders.payment', $packageOrder->id);
        }

        $message .= ', ' . __('msg.please_wait_for_provider_approval_to_do_the_payment_and_complete_the_order');
        Session::flash('package', $message);
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
    public function update($id, UpdatePackageOrderAPIRequest $request)
    {
        if(is_null($request->user_notes)) {
            return redirect()->back()->withErrors([
                'user_notes' => $response->message
            ]);
        }

        $request = app('App\Http\Controllers\API\PackageOrderAPIController')->update($id, $request);
        $response = $request->getData(); 
        if(!$response->success) {
            Flash::error($response->message);
            return redirect()->route('packageOrders.index');
        }

        Flash::success($response->message);
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
        $request = app('App\Http\Controllers\API\PackageOrderAPIController')->destroy($id);
        $response = $request->getData(); 
        if(!$response->success) {
            Flash::error($response->message);
            return redirect()->route('packageOrders.index');
        }

        Flash::success($response->message);
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
