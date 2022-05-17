<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdditionalAPIRequest;
use App\Http\Requests\API\UpdateAdditionalAPIRequest;
use App\Models\Additional;
use App\Repositories\AdditionalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AdditionalController
 * @package App\Http\Controllers\API
 */

class AdditionalAPIController extends AppBaseController
{
    /** @var  AdditionalRepository */
    private $additionalRepository;

    public function __construct(AdditionalRepository $additionalRepo)
    {
        $this->additionalRepository = $additionalRepo;
    }

    /**
     * Display a listing of the Additional.
     * GET|HEAD /additionals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $additionals = $this->additionalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $additionals->toArray(),
            __('messages.retrieved', ['model' => __('models/additionals.plural')])
        );
    }

    /**
     * Store a newly created Additional in storage.
     * POST /additionals
     *
     * @param CreateAdditionalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAdditionalAPIRequest $request)
    {
        $input = $request->all();

        $additional = $this->additionalRepository->create($input);

        return $this->sendResponse(
            $additional->toArray(),
            __('messages.saved', ['model' => __('models/additionals.singular')])
        );
    }

    /**
     * Display the specified Additional.
     * GET|HEAD /additionals/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Additional $additional */
        $additional = $this->additionalRepository->find($id);

        if (empty($additional)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/additionals.singular')])
            );
        }

        return $this->sendResponse(
            $additional->toArray(),
            __('messages.retrieved', ['model' => __('models/additionals.singular')])
        );
    }

    /**
     * Update the specified Additional in storage.
     * PUT/PATCH /additionals/{id}
     *
     * @param int $id
     * @param UpdateAdditionalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdditionalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Additional $additional */
        $additional = $this->additionalRepository->find($id);

        if (empty($additional)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/additionals.singular')])
            );
        }

        $additional = $this->additionalRepository->update($input, $id);

        return $this->sendResponse(
            $additional->toArray(),
            __('messages.updated', ['model' => __('models/additionals.singular')])
        );
    }

    /**
     * Remove the specified Additional from storage.
     * DELETE /additionals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Additional $additional */
        $additional = $this->additionalRepository->find($id);

        if (empty($additional)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/additionals.singular')])
            );
        }

        $additional->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/additionals.singular')])
        );
    }
}
