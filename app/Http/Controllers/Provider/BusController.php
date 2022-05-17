<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\CreateBusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Repositories\BusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Account;
use Flash;
use Response;
use Auth;

class BusController extends AppBaseController
{
    /** @var BusRepository $busRepository*/
    private $busRepository;

    public function __construct(BusRepository $busRepo)
    {
        $this->busRepository = $busRepo;

        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the Bus.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $buses = $this->busRepository->all(array_merge($request->all(), ['provider_id' => $this->provider_id]));

        $accounts = Account::where('provider_id', $this->provider_id)->pluck('username', 'id')->toArray();

        return view('provider.buses.index')
            ->with('buses', $buses)
            ->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new Bus.
     *
     * @return Response
     */
    public function create()
    {
        $accounts = Account::where([
            'provider_id' => $this->provider_id,
            'role' => 'driver'
        ])->pluck('username', 'id');

        return view('provider.buses.create')
            ->with('accounts', $accounts);
    }

    /**
     * Store a newly created Bus in storage.
     *
     * @param CreateBusRequest $request
     *
     * @return Response
     */
    public function store(CreateBusRequest $request)
    {
        $input = $request->all();
        $input['provider_id'] = $this->provider_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/buses'), $filename);
                $input['image'] = $filename;
            }
        }

        $bus = $this->busRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/buses.singular')]));
        return redirect(route('provider.buses.index'));
    }

    /**
     * Display the specified Bus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bus = $this->busRepository->find($id);

        if (empty($bus) || $bus->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/buses.singular')]));
            return redirect(route('provider.buses.index'));
        }

        return view('provider.buses.show')->with('bus', $bus);
    }

    /**
     * Show the form for editing the specified Bus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bus = $this->busRepository->find($id);

        if (empty($bus) || $bus->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/buses.singular')]));
            return redirect(route('provider.buses.index'));
        }

        $accounts = Account::where([
            'provider_id' => $this->provider_id,
            'role' => 'driver'
        ])->pluck('username', 'id');

        return view('provider.buses.edit')
            ->with('bus', $bus)
            ->with('accounts', $accounts);
    }

    /**
     * Update the specified Bus in storage.
     *
     * @param int $id
     * @param UpdateBusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBusRequest $request)
    {
        $bus = $this->busRepository->find($id);

        if (empty($bus) || $bus->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/buses.singular')]));
            return redirect(route('provider.buses.index'));
        }

        $input = $request->except('provider_id');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/buses'), $filename);
                $input['image'] = $filename;
            }
        }

        $bus = $this->busRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/buses.singular')]));
        return redirect(route('provider.buses.index'));
    }

    /**
     * Remove the specified Bus from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bus = $this->busRepository->find($id);

        if (empty($bus) || $bus->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/buses.singular')]));
            return redirect(route('provider.buses.index'));
        }

        $this->busRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/buses.singular')]));
        return redirect(route('provider.buses.index'));
    }
}
