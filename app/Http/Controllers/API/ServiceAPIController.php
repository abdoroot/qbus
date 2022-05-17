<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServiceAPIRequest;
use App\Http\Requests\API\UpdateServiceAPIRequest;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ServiceController
 * @package App\Http\Controllers\API
 */

class ServiceAPIController extends AppBaseController
{
    /** @var  ServiceRepository */
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
    }

    /**
     * Display a listing of the Service.
     * GET|HEAD /services
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $services = $this->serviceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $services->toArray(),
            __('messages.retrieved', ['model' => __('models/services.plural')])
        );
    }

    /**
     * Store a newly created Service in storage.
     * POST /services
     *
     * @param CreateServiceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateServiceAPIRequest $request)
    {
        $input = $request->all();

        $service = $this->serviceRepository->create($input);

        return $this->sendResponse(
            $service->toArray(),
            __('messages.saved', ['model' => __('models/services.singular')])
        );
    }

    /**
     * Display the specified Service.
     * GET|HEAD /services/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Service $service */
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/services.singular')])
            );
        }

        return $this->sendResponse(
            $service->toArray(),
            __('messages.retrieved', ['model' => __('models/services.singular')])
        );
    }

    /**
     * Update the specified Service in storage.
     * PUT/PATCH /services/{id}
     *
     * @param int $id
     * @param UpdateServiceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServiceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Service $service */
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/services.singular')])
            );
        }

        $service = $this->serviceRepository->update($input, $id);

        return $this->sendResponse(
            $service->toArray(),
            __('messages.updated', ['model' => __('models/services.singular')])
        );
    }

    /**
     * Remove the specified Service from storage.
     * DELETE /services/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Service $service */
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/services.singular')])
            );
        }

        $service->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/services.singular')])
        );
    }
}
