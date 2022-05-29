<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTripAPIRequest;
use App\Http\Requests\API\UpdateTripAPIRequest;
use App\Models\Additional;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Trip;
use App\Repositories\TripRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

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
        else{
            $array['data'] = ['message' => ""] ;
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
        DB::enableQueryLog();
        $limit = 6;
        $today = Carbon::now();

        $paginator = Trip::where(function ($query) use ($today) {
            $query->where('date_from', '>', $today->toDateString())
                ->orWhere(function ($query) use ($today)
                {
                    $query->where('date_from', '>=', $today->toDateString())
                        ->where('time_from', '>=', $today->toTimeString());
                }) ;
        });

        if(!is_null($search = $request->search)) {
            // $query .= "&search={$request->search}";
            $paginator = $paginator->where('description', 'like', "%$search%");
        }

        if(!empty($additional = $request->additional ?? [])) {
            $paginator = $paginator->when($additional , function($query) use ($additional) {
                $query->where(function ($query) use ($additional) {
                    foreach($additional as $addition) {
                        //$query->whereJsonContains('additional', ["id" => "3"]);
                        $query->where('additional', 'LIKE', '%"id":"' . $addition . '"%')
                            ->orWhere('additional', 'LIKE', '%"id": "' . $addition . '"%'); //added space
                    }
                });
            });
        }

        if(!is_null($date_from = $request->date_from)) {
            // $query .= "&date_from={$request->date_from}";
            $paginator = $paginator->where('date_from', '>=', $date_from);
        }

        if(!is_null($date_to = $request->date_to)) {
            // $query .= "&date_to={$request->date_to}";
            $paginator = $paginator->where('date_to', '<=', $date_to);
        }

        if(!is_null($time_from = $request->time_from)) {
            // $query .= "&time_from={$request->time_from}";
            $paginator = $paginator->where('time_from', '>=', $time_from);
        }
        if(!is_null($time_to = $request->time_to)) {
            // $query .= "&time_to={$request->time_to}";
            $paginator = $paginator->where('time_to', '<=', $time_to);
        }

        $from_city_id = $request->from_city_id;
        $to_city_id = $request->to_city_id;
        if(!is_null($from_city_id) || !is_null($to_city_id)) {
            $paginator = $paginator->join('destinations', 'destinations.id', '=', 'trips.destination_id');
            if(!is_null($from_city_id)) {
                // $query .= "&from_city_id={$request->from_city_id}";
                $paginator = $paginator->where('from_city_id', $from_city_id);
            }
            if(!is_null($to_city_id)) {
                // $query .= "&to_city_id={$request->to_city_id}";
                $paginator = $paginator->where('to_city_id', $to_city_id);
            }
        }

        if(!is_null($code = $request->code)) {
            // $query .= "&code={$request->code}";
            $provider_id = null;
            $coupon = Coupon::where(['code' => $request->code, 'status' => 'approved'])
                ->where('date_from', '<=', $today = Carbon::now()->toDateString())
                ->where('date_to', '>=', $today)
                ->first();
            if(!is_null($coupon)) $provider_id = $coupon->provider_id;

            $paginator = $paginator->where('trips.provider_id', $provider_id);
        }

        $paginator = $paginator->select('trips.*')->paginate($limit);

        //dd($paginator->items());

       // echo count($paginator->items());

        $cities = City::pluck('name', 'id');
        $additionals = Additional::get();

        return response()->json( $this->ReturnJson("success",['trips' => $paginator->items()],1),200);
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
