<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBusOrderAPIRequest;
use App\Http\Requests\API\UpdateBusOrderAPIRequest;
use App\Models\BusOrder;
use App\Repositories\BusOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use DB;
use App\Models\Notification;
use Auth;

/**
 * Class BusOrderController
 * @package App\Http\Controllers\API
 */

class BusOrderAPIController extends AppBaseController
{
    /** @var  BusOrderRepository */
    private $busOrderRepository;

    public function __construct(BusOrderRepository $busOrderRepo)
    {
        $this->busOrderRepository = $busOrderRepo;
    }

    /**
     * Display a listing of the BusOrder.
     * GET|HEAD /busOrders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $busOrders = $this->busOrderRepository->all(
            array_merge([
                'user_id' => $user->id,
                'user_archive' => 0
            ], $request->except(['skip', 'limit'])),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $busOrders->toArray(),
            __('messages.retrieved', ['model' => __('models/busOrders.plural')])
        );
    }

    /**
     * Store a newly created BusOrder in storage.
     * POST /busOrders
     *
     * @param CreateBusOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBusOrderAPIRequest $request)
    {
        $user = Auth::user();

        DB::beginTransaction();

        // $fees = app('\App\Http\Controllers\API\ProviderAPIController')->getFees($request->provider_id, $request->destination);
        // $data = $fees->getData();
        // $bus_fees = $data->data->bus_fees;

        $input = array_merge([
            'user_id' => $user->id,
            // 'fees'   => $bus_fees,
            // 'tax' => $tax = ($bus_fees * (!is_null($provider = Provider::find($request->provider_id)) ? $provider->tax : 0) / 100),
            // 'total' => $bus_fees + $tax,
            // 'status' => 'pending' // $bus_fees ? 'approved' : 'pending',
        ], $request->only(
            'lat',
            'lng',
            'zoom',
            'date_from',
            'time_from',
            'date_to',
            'time_to',
            'destination',
            'provider_id',
            'bus_id',
            'user_notes'
        ));

        // store busOrder
        $busOrder = $this->busOrderRepository->create($input);

        // store busOrder Datetimes (only if approved)
        // if($busOrder->status == 'approved') {
        //     $date = Carbon::parse($busOrder->date_from);
        //     while ($date->lte(Carbon::parse($busOrder->date_to))) {
        //         BusDatetime::create([
        //             'bus_order_id' => $busOrder->id,
        //             'bus_id' => $busOrder->bus_id,
        //             'date' => $date->format('Y-m-d'),
        //             'time_from' => $busOrder->time_from,
        //             'time_to' => $busOrder->time_to,
        //         ]);

        //         $date = $date->addDay();
        //     }
        // }

        // send notification to the provider
        $user_name = $busOrder->user->name;
        $notification = Notification::create([
            'title' => 'New bus order #' . $busOrder->id,
            'text' => "A new order has just been created by user <b> $user_name </b>, 
                order is " . __('models/busOrders.status.'.$busOrder->status) . ", please click to check more details.",
            'url' => route('provider.busOrders.show', $busOrder->id),
            'icon' => 'ti-truck',
            'type' => 'primary',
            'to' => 'provider',
            'provider_id' => $busOrder->provider_id
        ]);

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

        return $this->sendResponse(
            $busOrder->toArray(),
            __('messages.saved', ['model' => __('models/busOrders.singular')] . 
            ", " . __('msg.please_wait_for_provider_approval_to_do_the_payment_and_complete_the_order'))
        );
    }

    /**
     * Display the specified BusOrder.
     * GET|HEAD /busOrders/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();

        /** @var BusOrder $busOrder */
        $busOrder = $this->busOrderRepository->find($id);

        if (empty($busOrder) || $busOrder->user_id != $user->id) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/busOrders.singular')])
            );
        }
        
        $busOrder->destinationCities = $busOrder->destinationCities();

        return $this->sendResponse(
            $busOrder->toArray(),
            __('messages.retrieved', ['model' => __('models/busOrders.singular')])
        );
    }

    /**
     * Update the specified BusOrder in storage.
     * PUT/PATCH /busOrders/{id}
     *
     * @param int $id
     * @param UpdateBusOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBusOrderAPIRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        /** @var BusOrder $busOrder */
        $busOrder = $this->busOrderRepository->find($id);

        if (empty($busOrder) || $busOrder->user_id != $user->id) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/busOrders.singular')])
            );
        }

        if (!in_array($busOrder->status, ['pending', 'approved'])) {
            return $this->sendError(__('msg.unauthorized'));
        }

        DB::beginTransaction();

        if(is_null($user_notes = $request->user_notes)) {
            return $this->sendError(__('validation.required', ['attribute' => __('models/busOrders.fields.user_notes')]));
        }

        $input = [
            'status' => 'canceled',
            'user_notes' => $user_notes
        ];

        $busOrder = $this->busOrderRepository->update($input, $id);

        // send notification to the user
        $notification = Notification::create([
            'title' => 'Order #' . $busOrder->id,
            'text' => "The order is " . __('models/busOrders.status.'.$busOrder->status) .  ", please click to check more details.",
            'url' => route('provider.busOrders.show', $busOrder->id),
            'icon' => 'ti-close',
            'type' => 'danger',
            'to' => 'provider',
            'provider_id' => $busOrder->provider_id
        ]);

        DB::commit();

        return $this->sendResponse(
            $busOrder->toArray(),
            __('messages.updated', ['model' => __('models/busOrders.singular')])
        );
    }

    /**
     * Remove the specified BusOrder from storage.
     * DELETE /busOrders/{id}
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

        /** @var BusOrder $busOrder */
        $busOrder = $this->busOrderRepository->find($id);

        if (empty($busOrder) || $user->id != $busOrder->user_id) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/busOrders.singular')])
            );
        }

        $this->busOrderRepository->update(['user_archive' => 1], $id);

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/busOrders.singular')])
        );
    }
}
