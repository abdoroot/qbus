<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBusAPIRequest;
use App\Http\Requests\API\UpdateBusAPIRequest;
use App\Models\Bus;
use App\Models\BusDatetime;
use App\Repositories\BusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Response;

/**
 * Class BusController
 * @package App\Http\Controllers\API
 */

class BusAPIController extends AppBaseController
{
    /** @var  BusRepository */
    private $busRepository;

    public function __construct(BusRepository $busRepo)
    {
        $this->busRepository = $busRepo;
    }

    /**
     * Display a listing of the Bus.
     * GET|HEAD /buses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $buses = $this->busRepository->allQuery(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        if(!is_null($date_from = $request->date_from)
         && !is_null($date_to = $request->date_to)
         && !is_null($time_from = $request->time_from)
         && !is_null($time_to = $request->time_to)) {

            $dates = [];
            $date = Carbon::parse($date_from);
            while($date->lte(Carbon::parse($date_to))) {
                $dates[] = $date->format('Y-m-d');
                $date = $date->addDay();
            }

            $busDatetimes = BusDatetime::whereIn('bus_datetimes.date', $dates)
                ->where(function($query) use ($time_from, $time_to) {
                    $query->whereBetween('bus_datetimes.time_from', [$time_from, $time_to])
                        ->orWhereBetween('bus_datetimes.time_to', [$time_from, $time_to])
                        ->orWhere(function($query) use ($time_from, $time_to) {
                            $query->where('bus_datetimes.time_from', '<=', $time_from)
                                    ->where('bus_datetimes.time_to', '>=', $time_to);
                        });
                    });

            if(!is_null($busOrderId = $request->bus_order_id)) {
                $busDatetimes = $busDatetimes->where('bus_order_id', '!=', $busOrderId);
            }

            if(!is_null($tripId = $request->trip_id)) {
                $busDatetimes = $busDatetimes->where('trip_id', '!=', $tripId);
            }

            $busIds = $busDatetimes->pluck('bus_id')->toArray();
            $buses  = $buses->whereNotIn('id', $busIds);
        }

        $buses = $buses->get();

        return $this->sendResponse(
            $buses->toArray(),
            __('messages.retrieved', ['model' => __('models/buses.plural')])
        );
    }

    /**
     * Store a newly created Bus in storage.
     * POST /buses
     *
     * @param CreateBusAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBusAPIRequest $request)
    {
        $input = $request->all();

        $bus = $this->busRepository->create($input);

        return $this->sendResponse(
            $bus->toArray(),
            __('messages.saved', ['model' => __('models/buses.singular')])
        );
    }

    /**
     * Display the specified Bus.
     * GET|HEAD /buses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Bus $bus */
        $bus = $this->busRepository->find($id);

        if (empty($bus)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/buses.singular')])
            );
        }

        return $this->sendResponse(
            $bus->toArray(),
            __('messages.retrieved', ['model' => __('models/buses.singular')])
        );
    }

    /**
     * Update the specified Bus in storage.
     * PUT/PATCH /buses/{id}
     *
     * @param int $id
     * @param UpdateBusAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBusAPIRequest $request)
    {
        $input = $request->all();

        /** @var Bus $bus */
        $bus = $this->busRepository->find($id);

        if (empty($bus)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/buses.singular')])
            );
        }

        $bus = $this->busRepository->update($input, $id);

        return $this->sendResponse(
            $bus->toArray(),
            __('messages.updated', ['model' => __('models/buses.singular')])
        );
    }

    /**
     * Remove the specified Bus from storage.
     * DELETE /buses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Bus $bus */
        $bus = $this->busRepository->find($id);

        if (empty($bus)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/buses.singular')])
            );
        }

        $bus->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/buses.singular')])
        );
    }
}
