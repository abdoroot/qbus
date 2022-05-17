<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateBusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Repositories\BusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Account;
use Flash;
use Response;

class BusController extends AppBaseController
{
    /** @var BusRepository $busRepository*/
    private $busRepository;

    public function __construct(BusRepository $busRepo)
    {
        $this->busRepository = $busRepo;
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
        $buses = $this->busRepository->all($request->all());
        $providers = Provider::pluck('name', 'id')->toArray();
        $accounts = Account::pluck('username', 'id')->toArray();

        return view('admin.buses.index')
            ->with('buses', $buses)
            ->with('providers', $providers)
            ->with('accounts', $accounts);
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

        if (empty($bus)) {
            Flash::error(__('messages.not_found', ['model' => __('models/buses.singular')]));
            return redirect(route('admin.buses.index'));
        }

        return view('admin.buses.show')->with('bus', $bus);
    }
}
