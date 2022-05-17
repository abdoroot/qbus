<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\TripRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Destination;
use App\Models\Additional;
use App\Models\Bus;
use Flash;
use Response;

class TripController extends AppBaseController
{
    /** @var TripRepository $tripRepository*/
    private $tripRepository;

    public function __construct(TripRepository $tripRepo)
    {
        $this->tripRepository = $tripRepo;
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
        $trips = $this->tripRepository->all($request->all());

        $providers = Provider::pluck('name', 'id');
        $destinations = Destination::get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');
        $additionals = Additional::pluck('name', 'id');
        $buses = Bus::pluck('plate', 'id');

        return view('admin.trips.index')
            ->with('trips', $trips)
            ->with('providers', $providers)
            ->with('destinations', $destinations)
            ->with('additionals', $additionals)
            ->with('buses', $buses);
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

        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('admin.trips.index'));
        }

        return view('admin.trips.show')->with('trip', $trip);
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

        if (empty($trip)) {
            Flash::error(__('messages.not_found', ['model' => __('models/trips.singular')]));
            return redirect(route('admin.trips.index'));
        }

        $this->tripRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/trips.singular')]));
        return redirect(route('admin.trips.index'));
    }
}
