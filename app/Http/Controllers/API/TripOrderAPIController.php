<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTripOrderAPIRequest;
use App\Http\Requests\API\UpdateTripOrderAPIRequest;
use App\Models\TripOrder;
use App\Repositories\TripOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TripOrderController
 * @package App\Http\Controllers\API
 */

class TripOrderAPIController extends AppBaseController
{
    /** @var  TripOrderRepository */
    private $tripOrderRepository;

    public function __construct(TripOrderRepository $tripOrderRepo)
    {
        $this->tripOrderRepository = $tripOrderRepo;
    }

    /**
     * Display a listing of the TripOrder.
     * GET|HEAD /tripOrders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tripOrders = $this->tripOrderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $tripOrders->toArray(),
            __('messages.retrieved', ['model' => __('models/tripOrders.plural')])
        );
    }

    /**
     * Store a newly created TripOrder in storage.
     * POST /tripOrders
     *
     * @param CreateTripOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTripOrderAPIRequest $request)
    {
        $input = $request->all();

        $tripOrder = $this->tripOrderRepository->create($input);

        return $this->sendResponse(
            $tripOrder->toArray(),
            __('messages.saved', ['model' => __('models/tripOrders.singular')])
        );
    }

    /**
     * Display the specified TripOrder.
     * GET|HEAD /tripOrders/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TripOrder $tripOrder */
        $tripOrder = $this->tripOrderRepository->find($id);

        if (empty($tripOrder)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tripOrders.singular')])
            );
        }

        return $this->sendResponse(
            $tripOrder->toArray(),
            __('messages.retrieved', ['model' => __('models/tripOrders.singular')])
        );
    }

    /**
     * Update the specified TripOrder in storage.
     * PUT/PATCH /tripOrders/{id}
     *
     * @param int $id
     * @param UpdateTripOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTripOrderAPIRequest $request)
    {
        $input = $request->all();

        /** @var TripOrder $tripOrder */
        $tripOrder = $this->tripOrderRepository->find($id);

        if (empty($tripOrder)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tripOrders.singular')])
            );
        }

        $tripOrder = $this->tripOrderRepository->update($input, $id);

        return $this->sendResponse(
            $tripOrder->toArray(),
            __('messages.updated', ['model' => __('models/tripOrders.singular')])
        );
    }

    /**
     * Remove the specified TripOrder from storage.
     * DELETE /tripOrders/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TripOrder $tripOrder */
        $tripOrder = $this->tripOrderRepository->find($id);

        if (empty($tripOrder)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tripOrders.singular')])
            );
        }

        $tripOrder->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/tripOrders.singular')])
        );
    }
}
