<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTripAPIRequest;
use App\Http\Requests\API\UpdateTripAPIRequest;
use App\Models\Trip;
use App\Repositories\TripRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TripController
 * @package App\Http\Controllers\API
 */

class TripAPIController extends AppBaseController
{
    /** @var  TripRepository */
    private $tripRepository;

    public function __construct(TripRepository $tripRepo)
    {
        $this->tripRepository = $tripRepo;
    }


    public function ReturnJson($message,$data,$code = 1){
        $array = [
            'message' => $message,
            'code' => $code,
        ];

        if($data != ""){
            $array['data'] = $data;
        }
        return $array;
    }

    /**
     * Display a listing of the Trip.
     * GET|HEAD /trips
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $limit = 6;
        $today = Carbon::now();

        $paginator = Trip::all()->where('date_from', '>=', $today->toDateString())->where('time_from', '>', $today->toTimeString());
       //$paginator->query
//        if(!empty($additional = $request->additional ?? [])) {
//            $paginator = $paginator->when($additional , function($query) use ($additional) {
//                $query->where(function ($query) use ($additional) {
//                    foreach($additional as $addition) {
//                        $query->whereJsonContains('additional', ['id' => $addition]);
//                    }
//                });
//            });
//        }

        return response()->json( $this->ReturnJson("success",['trips' => $paginator],1),200);
    }

    /**
     * Store a newly created Trip in storage.
     * POST /trips
     *
     * @param CreateTripAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTripAPIRequest $request)
    {
        $input = $request->all();

        $trip = $this->tripRepository->create($input);

        return $this->sendResponse(
            $trip->toArray(),
            __('messages.saved', ['model' => __('models/trips.singular')])
        );
    }

    /**
     * Display the specified Trip.
     * GET|HEAD /trips/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Trip $trip */
        $trip = $this->tripRepository->find($id);

        if (empty($trip)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/trips.singular')])
            );
        }

        return $this->sendResponse(
            $trip->toArray(),
            __('messages.retrieved', ['model' => __('models/trips.singular')])
        );
    }

    /**
     * Update the specified Trip in storage.
     * PUT/PATCH /trips/{id}
     *
     * @param int $id
     * @param UpdateTripAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTripAPIRequest $request)
    {
        $input = $request->all();

        /** @var Trip $trip */
        $trip = $this->tripRepository->find($id);

        if (empty($trip)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/trips.singular')])
            );
        }

        $trip = $this->tripRepository->update($input, $id);

        return $this->sendResponse(
            $trip->toArray(),
            __('messages.updated', ['model' => __('models/trips.singular')])
        );
    }

    /**
     * Remove the specified Trip from storage.
     * DELETE /trips/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Trip $trip */
        $trip = $this->tripRepository->find($id);

        if (empty($trip)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/trips.singular')])
            );
        }

        $trip->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/trips.singular')])
        );
    }

    /**
     * Get the specified Trip Additionals.
     * GET|HEAD /trips/get-additionals
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getAdditionals(Request $request)
    {
        /** @var Trip $trip */
        $trip = $this->tripRepository->find($request->trip_id);
        if (empty($trip)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/trips.singular')])
            );
        }

        return $this->sendResponse(
            $trip->additionals(),
            __('messages.retrieved', ['model' => __('models/trips.singular')])
        );
    }
}
