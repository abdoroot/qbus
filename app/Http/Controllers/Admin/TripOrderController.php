<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTripOrderRequest;
use App\Http\Requests\UpdateTripOrderRequest;
use App\Repositories\TripOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\TripOrder;
use App\Models\Provider;
use App\Models\Trip;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Notification;
use App\Models\Ticket;
use Flash;
use Response;
use DB;

class TripOrderController extends AppBaseController
{
    /** @var TripOrderRepository $tripOrderRepository*/
    private $tripOrderRepository;

    public function __construct(TripOrderRepository $tripOrderRepo)
    {
        $this->tripOrderRepository = $tripOrderRepo;
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
        $tripOrders = $this->tripOrderRepository->all($request->all());

        $providers = Provider::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $coupons = Coupon::pluck('name', 'id');
        $trips = Trip::pluck('id', 'id');

        return view('admin.trip_orders.index')
            ->with('tripOrders', $tripOrders)
            ->with('providers', $providers)
            ->with('users', $users)
            ->with('coupons', $coupons)
            ->with('trips', $trips);
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

        if (empty($tripOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('admin.tripOrders.index'));
        }

        return view('admin.trip_orders.show')->with('tripOrder', $tripOrder);
    }

    /**
     * Update the specified TripOrder in storage.
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
        $tripOrder = $this->tripOrderRepository->find($id);
        if (empty($tripOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('admin.tripOrders.index'));
        }

        $rules = TripOrder::$admin_rules;
        if($tripOrder->status == 'paid') $rules['return'] = 'required|in:bank,wallet';
        $this->validate($request, $rules);

        if (in_array($tripOrder->status, ['canceled', 'rejected'])) {
            Flash::error(__('msg.order_is_already') . __('models/tripOrders.status.'.$tripOrder->status));
            return redirect()->back();
        }

        DB::beginTransaction();

        $input = $request->only('admin_notes');
        $input['status'] = 'rejected';

        if($tripOrder->status == 'paid') {
            if($request->return == 'wallet' && !is_null($user = User::find($tripOrder->user_id))) {
                $wallet = $user->wallet + $tripOrder->total;
                $user->update(['wallet' => $wallet]);
            } else {
                // return money to user bank (depending on payment gateway)
                // code ...
            }
        }

        Ticket::where('trip_order_id', $id)->delete();

        $tripOrder = $this->tripOrderRepository->update($input, $id);

        Notification::create([
            'title' => __('models/tripOrders.singular') . '#'. $tripOrder->id,
            'text' => $tripOrder->admin_notes,
            'url' => route('tripOrders.show', $tripOrder->id),
            'icon' => 'icon-info',
            'type' => 'danger',
            'to' => 'user',
            'user_id' => $tripOrder->user_id,
        ]);

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/tripOrders.singular')]));
        return redirect(route('admin.tripOrders.index'));
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

        if (empty($tripOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/tripOrders.singular')]));
            return redirect(route('admin.tripOrders.index'));
        }

        $this->tripOrderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/tripOrders.singular')]));
        return redirect(route('admin.tripOrders.index'));
    }
}
