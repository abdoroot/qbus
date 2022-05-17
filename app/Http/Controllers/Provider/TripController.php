<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\CreateTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Repositories\TripRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\City;
use App\Models\BusDatetime;
use App\Models\Destination;
use App\Models\Additional;
use App\Models\Notification;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;
use DB;

class TripController extends AppBaseController
{
    /** @var TripRepository $tripRepository*/
    private $tripRepository;

    public function __construct(TripRepository $tripRepo)
    {
        $this->tripRepository = $tripRepo;
        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the Trip.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $input['provider_id'] = $this->provider_id;
        $input['provider_archive'] = $request->archive ?? 0;

        $trips = $this->tripRepository->all($input);

        $destinations = Destination::where('provider_id', $this->provider_id)->get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');
        $additionals = Additional::pluck('name', 'id');
        $buses = Bus::where('provider_id', $this->provider_id)->pluck('plate', 'id');

        return view('provider.trips.index')
            ->with('trips', $trips)
            ->with('destinations', $destinations)
            ->with('additionals', $additionals)
            ->with('buses', $buses);
    }

    /**
     * Show the form for creating a new Trip.
     *
     * @return Response
     */
    public function create()
    {
        $buses = Bus::where(['provider_id' => $this->provider_id, 'active' => true])->pluck('plate', 'id');

        $destinations = Destination::where('provider_id', $this->provider_id)->get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');
        
        $additionals = Additional::get();

        return view('provider.trips.create')
            ->with('buses', $buses)
            ->with('destinations', $destinations)
            ->with('additionals', $additionals);
    }

    /**
     * Store a newly created Trip in storage.
     *
     * @param CreateTripRequest $request
     *
     * @return Response
     */
    public function store(CreateTripRequest $request)
    {
        $input = $request->all();
        $input['provider_id'] = $this->provider_id;
        $input['max'] = (!is_null($bus = Bus::find($request->bus_id)) ? $bus->passengers : 0);

        DB::beginTransaction();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/trips'), $filename);
                $input['image'] = $filename;
            }
        }

        $input['additional'] = array_filter($request->additional, function($additional) {
            return isset($additional['id']);
        });

        $trip = $this->tripRepository->create($input);

        // Store Bus Datetimes
        $date = Carbon::parse($trip->date_from);
        while ($date->lte(Carbon::parse($trip->date_to))) {
            BusDatetime::create([
                'trip_id' => $trip->id,
                'bus_id' => $trip->bus_id,
                'date' => $date->format('Y-m-d'),
                'time_from' => $trip->time_from,
                'time_to' => $trip->time_to,
            ]);

            $date = $date->addDay();
        }

        // notify the bus driver

        DB::commit();

        Flash::success(__('messages.saved', ['model' => __('models/trips.singular')]));
        return redirect(route('provider.trips.index'));
    }

    /**
     * Display the specified Trip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $trip = $this->tripRepository->find($id);
        if (empty($trip) || $trip->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('provider.trips.index'));
        }

        return view('provider.trips.show')->with('trip', $trip);
    }

    /**
     * Show the form for editing the specified Trip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $trip = $this->tripRepository->find($id);
        if (empty($trip) || $trip->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('provider.trips.index'));
        }

        // $request = new Request();
        // $request->replace([
        //     'provider_id' => $trip->provider_id,
        //     'date_from' => $trip->date_from,
        //     'date_to' => $trip->date_to,
        //     'time_from' => $trip->time_from,
        //     'time_to' => $trip->time_to,
        //     'trip_id' => $trip->id,
        // ]);

        // $getBuses = app('App\Http\Controllers\API\BusAPIController')->index($request);
        // $data = $getBuses->getData();

        // $buses = collect($data->data)->pluck('plate', 'id')->toArray();
        $buses = Bus::where(['provider_id' => $this->provider_id, 'active' => true])->pluck('plate', 'id');

        $destinations = Destination::where('provider_id', $this->provider_id)->get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');
        
        $additionals = Additional::get();

        return view('provider.trips.edit')
            ->with('trip', $trip)
            ->with('buses', $buses)
            ->with('destinations', $destinations)
            ->with('additionals', $additionals);
    }

    /**
     * Update the specified Trip in storage.
     *
     * @param int $id
     * @param UpdateTripRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTripRequest $request)
    {
        $trip = $this->tripRepository->find($id);
        if (empty($trip) || $trip->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('provider.trips.index'));
        }

        $input = $request->except('provider_id');

        DB::beginTransaction();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/trips'), $filename);
                $input['image'] = $filename;
            }
        }

        $input['additional'] = array_filter($request->additional, function($additional) {
            return isset($additional['id']);
        });

        $trip = $this->tripRepository->update($input, $id);

        // Store Bus Datetimes
        $date = Carbon::parse($trip->date_from);
        $ids = [];
        while ($date->lte(Carbon::parse($trip->date_to))) {
            $busDatetime = BusDatetime::firstOrCreate([
                'trip_id' => $trip->id,
                'bus_id' => $trip->bus_id,
                'date' => $date->format('Y-m-d'),
                'time_from' => $trip->time_from,
                'time_to' => $trip->time_to,
            ]);

            $date = $date->addDay();
            $ids[] = $busDatetime->id;
        }

        BusDatetime::where('trip_id', $trip->id)->whereNotIn('id', $ids)->delete();

        // notify the bus driver

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/trips.singular')]));
        return redirect(route('provider.trips.index'));
    }

    /**
     * Remove the specified Trip from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $trip = $this->tripRepository->find($id);

        if (empty($trip) || $trip->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('provider.trips.index'));
        }

        $this->tripRepository->update(['provider_archive' => 1], $id);

        Flash::success(__('messages.deleted', ['model' => __('models/trips.singular')]));
        return redirect(route('provider.trips.index'));
    }

    /**
     * Send notification to the specified Trip users.
     *
     * @param int $id
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function notification($id, Request $request)
    {
        $this->validate($request, ['text' => 'required|string']);

        $trip = $this->tripRepository->find($id);
        if (empty($trip) || $trip->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('provider.trips.index'));
        }

        foreach($trip->tripOrders as $tripOrder) {
            if(!is_null($tripOrder->user_id)) {
                $userNotif = Notification::create([
                    'title' => 'Trip #' . $trip->id,
                    'text' => $request->text,
                    'url' => route('tripOrders.show', $tripOrder->id),
                    'icon' => 'ti-info',
                    'type' => 'info',
                    'to' => 'user',
                    'user_id' => $tripOrder->user_id
                ]);
            }
        }

        Flash::success(__('messages.saved', ['model' => __('models/notifications.singular')]));
        return redirect(route('provider.trips.show', $id));
    }
}
