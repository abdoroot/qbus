<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateBusOrderRequest;
use App\Http\Requests\UpdateBusOrderRequest;
use App\Repositories\BusOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Destination;
use App\Models\User;
use App\Models\Bus;
use App\Models\Notification;
use App\Models\BusOrder;
use Flash;
use Response;
use DB;

class BusOrderController extends AppBaseController
{
    /** @var BusOrderRepository $busOrderRepository*/
    private $busOrderRepository;

    public function __construct(BusOrderRepository $busOrderRepo)
    {
        $this->busOrderRepository = $busOrderRepo;
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
        $busOrders = $this->busOrderRepository->all($request->all());

        $providers = Provider::pluck('name', 'id');
        $destinations = Destination::get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $buses = Bus::pluck('plate', 'id');

        return view('admin.bus_orders.index')
            ->with('busOrders', $busOrders)
            ->with('providers', $providers)
            ->with('destinations', $destinations)
            ->with('users', $users)
            ->with('buses', $buses);
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
        if (empty($busOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('admin.busOrders.index'));
        }

        return view('admin.bus_orders.show')
            ->with('busOrder', $busOrder)
            ->with('active', $request->active);
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
        if (empty($busOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('admin.busOrders.index'));
        }

        $rules = BusOrder::$admin_rules;
        if($busOrder->status == 'paid') $rules['return'] = 'required|in:bank,wallet';
        $this->validate($request, $rules);

        if (in_array($busOrder->status, ['canceled', 'rejected', 'complete'])) {
            Flash::error(__('msg.order_is_already') . __('models/busOrders.status.'.$busOrder->status));
            return redirect()->back();
        }

        DB::beginTransaction();

        $input = $request->only('admin_notes');
        $input['status'] = 'rejected';

        if($busOrder->status == 'paid') {
            if($request->return == 'wallet' && !is_null($user = User::find($busOrder->user_id))) {
                $wallet = $user->wallet + $busOrder->total;
                $user->update(['wallet' => $wallet]);
            } else {
                // return money to user bank (depending on payment gateway)
                // code ...
            }
        }

        $busOrder = $this->busOrderRepository->update($input, $id);

        Notification::create([
            'title' => __('models/busOrders.singular') . '#'. $busOrder->id,
            'text' => $busOrder->admin_notes,
            'url' => route('busOrders.show', $busOrder->id),
            'icon' => 'icon-info',
            'type' => 'danger',
            'to' => 'user',
            'user_id' => $busOrder->user_id,
        ]);

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/busOrders.singular')]));
        return redirect(route('admin.busOrders.index'));
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

        if (empty($busOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('admin.busOrders.index'));
        }

        $this->busOrderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/busOrders.singular')]));
        return redirect(route('admin.busOrders.index'));
    }
}
