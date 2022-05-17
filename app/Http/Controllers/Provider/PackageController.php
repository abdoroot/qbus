<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\CreatePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Repositories\PackageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\City;
use App\Models\Additional;
use Flash;
use Response;
use Auth;

class PackageController extends AppBaseController
{
    /** @var PackageRepository $packageRepository*/
    private $packageRepository;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepository = $packageRepo;
        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the Package.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $packages = $this->packageRepository->all(array_merge($request->all(), ['provider_id' => $this->provider_id]));

        $destinations = Destination::where('provider_id', $this->provider_id)->get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');
        $additionals = Additional::pluck('name', 'id');
        $cities = City::pluck('name', 'id');

        return view('provider.packages.index')
            ->with('packages', $packages)
            ->with('destinations', $destinations)
            ->with('additionals', $additionals)
            ->with('cities', $cities);
    }

    /**
     * Show the form for creating a new Package.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::pluck('name', 'id');
        
        $destinations = Destination::where('provider_id', $this->provider_id)->get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');
        
        $additionals = Additional::get();

        return view('provider.packages.create')
            ->with('cities', $cities)
            ->with('destinations', $destinations)
            ->with('additionals', $additionals);
    }

    /*
    /**
     * Store a newly created Package in storage.
     *
     * @param CreatePackageRequest $request
     *
     * @return Response
     */
    public function store(CreatePackageRequest $request)
    {
        $input = $request->all();
        $input['provider_id'] = $this->provider_id;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/packages'), $filename);
                $input['image'] = $filename;
            }
        }

        $input['additional'] = array_filter($request->additional, function($additional) {
            return isset($additional['id']);
        });
        
        $package = $this->packageRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/packages.singular')]));
        return redirect(route('provider.packages.index'));
    }

    /**
     * Display the specified Package.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $package = $this->packageRepository->find($id);
        if (empty($package) || $package->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packages.singular')]));
            return redirect(route('provider.packages.index'));
        }

        return view('provider.packages.show')
            ->with('package', $package);
    }

    /**
     * Show the form for editing the specified Package.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $package = $this->packageRepository->find($id);
        if (empty($package) || $package->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packages.singular')]));
            return redirect(route('provider.packages.index'));
        }

        $cities = City::pluck('name', 'id');

        $destinations = Destination::where('provider_id', $this->provider_id)->get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');

        $additionals = Additional::get();

        return view('provider.packages.edit')
            ->with('package', $package)
            ->with('cities', $cities)
            ->with('destinations', $destinations)
            ->with('additionals', $additionals);
    }

    /**
     * Update the specified Package in storage.
     *
     * @param int $id
     * @param UpdatePackageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackageRequest $request)
    {
        $package = $this->packageRepository->find($id);
        if (empty($package) || $package->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packages.singular')]));
            return redirect(route('provider.packages.index'));
        }

        $input = $request->except('provider_id');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/packages'), $filename);
                $input['image'] = $filename;
            }
        }

        $input['additional'] = array_filter($request->additional, function($additional) {
            return isset($additional['id']);
        });

        $package = $this->packageRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/packages.singular')]));
        return redirect(route('provider.packages.index'));
    }

    /**
     * Remove the specified Package from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $package = $this->packageRepository->find($id);

        if (empty($package) || $package->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/packages.singular')]));
            return redirect(route('provider.packages.index'));
        }

        $this->packageRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/packages.singular')]));
        return redirect(route('provider.packages.index'));
    }
}
