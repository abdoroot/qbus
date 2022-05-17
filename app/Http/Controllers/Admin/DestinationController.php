<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DestinationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\City;
use App\Models\Terminal;
use Flash;
use Response;

class DestinationController extends AppBaseController
{
    /** @var DestinationRepository $destinationRepository*/
    private $destinationRepository;

    public function __construct(DestinationRepository $destinationRepo)
    {
        $this->destinationRepository = $destinationRepo;
    }

    /**
     * Display a listing of the Destination.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $destinations = $this->destinationRepository->all($request->all());
        
        $providers = Provider::pluck('name', 'id')->toArray();
        $cities = City::pluck('name', 'id')->toArray();
        $terminals = Terminal::pluck('name', 'id')->toArray();

        return view('admin.destinations.index')
            ->with('destinations', $destinations)
            ->with('providers', $providers)
            ->with('cities', $cities)
            ->with('terminals', $terminals);
    }

    /**
     * Display the specified Destination.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $destination = $this->destinationRepository->find($id);

        if (empty($destination)) {
            Flash::error(__('messages.not_found', ['model' => __('models/destinations.singular')]));
            return redirect(route('admin.destinations.index'));
        }

        return view('admin.destinations.show')->with('destination', $destination);
    }
}
