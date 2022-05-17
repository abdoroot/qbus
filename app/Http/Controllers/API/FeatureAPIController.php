<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFeatureAPIRequest;
use App\Http\Requests\API\UpdateFeatureAPIRequest;
use App\Models\Feature;
use App\Repositories\FeatureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FeatureController
 * @package App\Http\Controllers\API
 */

class FeatureAPIController extends AppBaseController
{
    /** @var  FeatureRepository */
    private $featureRepository;

    public function __construct(FeatureRepository $featureRepo)
    {
        $this->featureRepository = $featureRepo;
    }

    /**
     * Display a listing of the Feature.
     * GET|HEAD /features
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $features = $this->featureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $features->toArray(),
            __('messages.retrieved', ['model' => __('models/features.plural')])
        );
    }

    /**
     * Store a newly created Feature in storage.
     * POST /features
     *
     * @param CreateFeatureAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFeatureAPIRequest $request)
    {
        $input = $request->all();

        $feature = $this->featureRepository->create($input);

        return $this->sendResponse(
            $feature->toArray(),
            __('messages.saved', ['model' => __('models/features.singular')])
        );
    }

    /**
     * Display the specified Feature.
     * GET|HEAD /features/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Feature $feature */
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/features.singular')])
            );
        }

        return $this->sendResponse(
            $feature->toArray(),
            __('messages.retrieved', ['model' => __('models/features.singular')])
        );
    }

    /**
     * Update the specified Feature in storage.
     * PUT/PATCH /features/{id}
     *
     * @param int $id
     * @param UpdateFeatureAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeatureAPIRequest $request)
    {
        $input = $request->all();

        /** @var Feature $feature */
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/features.singular')])
            );
        }

        $feature = $this->featureRepository->update($input, $id);

        return $this->sendResponse(
            $feature->toArray(),
            __('messages.updated', ['model' => __('models/features.singular')])
        );
    }

    /**
     * Remove the specified Feature from storage.
     * DELETE /features/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Feature $feature */
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/features.singular')])
            );
        }

        $feature->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/features.singular')])
        );
    }
}
