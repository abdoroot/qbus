<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBusOrderAPIRequest;
use App\Http\Requests\API\UpdateBusOrderAPIRequest;
use App\Models\BusOrder;
use App\Repositories\BusOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

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
        $busOrders = $this->busOrderRepository->all(
            $request->except(['skip', 'limit']),
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
        $input = $request->all();

        $busOrder = $this->busOrderRepository->create($input);

        return $this->sendResponse(
            $busOrder->toArray(),
            __('messages.saved', ['model' => __('models/busOrders.singular')])
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
        /** @var BusOrder $busOrder */
        $busOrder = $this->busOrderRepository->find($id);

        if (empty($busOrder)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/busOrders.singular')])
            );
        }

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
        $input = $request->all();

        /** @var BusOrder $busOrder */
        $busOrder = $this->busOrderRepository->find($id);

        if (empty($busOrder)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/busOrders.singular')])
            );
        }

        $busOrder = $this->busOrderRepository->update($input, $id);

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
        /** @var BusOrder $busOrder */
        $busOrder = $this->busOrderRepository->find($id);

        if (empty($busOrder)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/busOrders.singular')])
            );
        }

        $busOrder->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/busOrders.singular')])
        );
    }
}
