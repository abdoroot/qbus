<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDestinationAPIRequest;
use App\Http\Requests\API\UpdateDestinationAPIRequest;
use App\Models\Destination;
use App\Repositories\DestinationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DestinationController
 * @package App\Http\Controllers\API
 */

class DestinationAPIController extends AppBaseController
{
    /** @var  DestinationRepository */
    private $destinationRepository;

    public function __construct(DestinationRepository $destinationRepo)
    {
        $this->destinationRepository = $destinationRepo;
    }

    /**
     * Display a listing of the Destination.
     * GET|HEAD /destinations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $destinations = $this->destinationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $destinations->toArray(),
            __('messages.retrieved', ['model' => __('models/destinations.plural')])
        );
    }

    /**
     * Store a newly created Destination in storage.
     * POST /destinations
     *
     * @param CreateDestinationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDestinationAPIRequest $request)
    {
        $input = $request->all();

        $destination = $this->destinationRepository->create($input);

        return $this->sendResponse(
            $destination->toArray(),
            __('messages.saved', ['model' => __('models/destinations.singular')])
        );
    }

    /**
     * Display the specified Destination.
     * GET|HEAD /destinations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Destination $destination */
        $destination = $this->destinationRepository->find($id);

        if (empty($destination)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/destinations.singular')])
            );
        }

        return $this->sendResponse(
            $destination->toArray(),
            __('messages.retrieved', ['model' => __('models/destinations.singular')])
        );
    }

    /**
     * Update the specified Destination in storage.
     * PUT/PATCH /destinations/{id}
     *
     * @param int $id
     * @param UpdateDestinationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDestinationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Destination $destination */
        $destination = $this->destinationRepository->find($id);

        if (empty($destination)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/destinations.singular')])
            );
        }

        $destination = $this->destinationRepository->update($input, $id);

        return $this->sendResponse(
            $destination->toArray(),
            __('messages.updated', ['model' => __('models/destinations.singular')])
        );
    }

    /**
     * Remove the specified Destination from storage.
     * DELETE /destinations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Destination $destination */
        $destination = $this->destinationRepository->find($id);

        if (empty($destination)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/destinations.singular')])
            );
        }

        $destination->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/destinations.singular')])
        );
    }
}
