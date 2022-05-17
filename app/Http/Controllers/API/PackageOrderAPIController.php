<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePackageOrderAPIRequest;
use App\Http\Requests\API\UpdatePackageOrderAPIRequest;
use App\Models\PackageOrder;
use App\Repositories\PackageOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

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
        $packageOrders = $this->packageOrderRepository->all(
            $request->except(['skip', 'limit']),
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
        $input = $request->all();

        $packageOrder = $this->packageOrderRepository->create($input);

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
        /** @var PackageOrder $packageOrder */
        $packageOrder = $this->packageOrderRepository->find($id);

        if (empty($packageOrder)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packageOrders.singular')])
            );
        }

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
        $input = $request->all();

        /** @var PackageOrder $packageOrder */
        $packageOrder = $this->packageOrderRepository->find($id);

        if (empty($packageOrder)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packageOrders.singular')])
            );
        }

        $packageOrder = $this->packageOrderRepository->update($input, $id);

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
        /** @var PackageOrder $packageOrder */
        $packageOrder = $this->packageOrderRepository->find($id);

        if (empty($packageOrder)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packageOrders.singular')])
            );
        }

        $packageOrder->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/packageOrders.singular')])
        );
    }
}
