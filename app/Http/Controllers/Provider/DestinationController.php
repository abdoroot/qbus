<?php

namespace App\Http\Controllers\Provider;

use App\Repositories\DestinationRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Terminal;
use Flash;
use Response;
use Auth;

class DestinationController extends AppBaseController
{
    /** @var DestinationRepository $destinationRepository*/
    private $destinationRepository;

    public function __construct(DestinationRepository $destinationRepo)
    {
        $this->destinationRepository = $destinationRepo;
        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
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
        $destinations = $this->destinationRepository->all(array_merge($request->all(), ['provider_id' => $this->provider_id]));

        $cities = City::pluck('name', 'id')->toArray();
        $terminals = Terminal::where('provider_id', $this->provider_id)->pluck('name', 'id')->toArray();

        return view('provider.destinations.index')
            ->with('destinations', $destinations)
            ->with('cities', $cities)
            ->with('terminals', $terminals);
    }

    /**
     * Show the form for creating a new Destination.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::pluck('name', 'id');
        $terminals = Terminal::where('provider_id', $this->provider_id)->pluck('name', 'id');

        return view('provider.destinations.create')
            ->with('cities', $cities)
            ->with('terminals', $terminals);
    }

    /**
     * Store a newly created Destination in storage.
     *
     * @param CreateDestinationRequest $request
     *
     * @return Response
     */
    public function store(CreateDestinationRequest $request)
    {
        $input = $request->all();
        $input['provider_id'] = $this->provider_id;

        $destination = $this->destinationRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/destinations.singular')]));
        return redirect(route('provider.destinations.index'));
    }

    public function show($id)
    {
        $destination = $this->destinationRepository->find($id);
        if (empty($destination) || $destination->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/destinations.singular')]));
            return redirect(route('provider.destinations.index'));
        }

        return view('provider.destinations.show')
            ->with('destination', $destination);
    }
    public function edit($id)
    {
        $destination = $this->destinationRepository->find($id);
        if (empty($destination) || $destination->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/destinations.singular')]));
            return redirect(route('provider.destinations.index'));
        }

        $cities = City::pluck('name', 'id');
        $terminals = Terminal::where('provider_id', $this->provider_id)->pluck('name', 'id');

        return view('provider.destinations.edit')
            ->with('destination', $destination)
            ->with('cities', $cities)
            ->with('terminals', $terminals);
    }

    public function update($id, UpdateDestinationRequest $request)
    {
        $input = $request->all();
        $input['provider_id'] = $this->provider_id;

        $destination = $this->destinationRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/destinations.singular')]));
        return redirect(route('provider.destinations.index'));
    }

    /**
     * Remove the specified Destination from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $destination = $this->destinationRepository->find($id);

        if (empty($destination) || $destination->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/destinations.singular')]));
            return redirect(route('provider.destinations.index'));
        }

        $this->destinationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/destinations.singular')]));
        return redirect(route('provider.destinations.index'));
    }
}
