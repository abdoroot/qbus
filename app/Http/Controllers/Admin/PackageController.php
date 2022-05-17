<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PackageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\PackageCity;
use App\Models\Provider;
use App\Models\Destination;
use App\Models\Additional;
use App\Models\City;
use Flash;
use Response;

class PackageController extends AppBaseController
{
    /** @var PackageRepository $packageRepository*/
    private $packageRepository;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepository = $packageRepo;
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
        $packages = $this->packageRepository->all($request->all());

        $providers = Provider::pluck('name', 'id');
        $destinations = Destination::get();
        $destinations = $destinations->each(function ($model) { $model->setAppends(['name']); });
        $destinations = $destinations->pluck('name', 'id');
        $additionals = Additional::pluck('name', 'id');
        $cities = City::pluck('name', 'id');

        return view('admin.packages.index')
            ->with('packages', $packages)
            ->with('providers', $providers)
            ->with('destinations', $destinations)
            ->with('additionals', $additionals)
            ->with('cities', $cities);
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

        if (empty($package)) {
            Flash::error(__('messages.not_found', ['model' => __('models/packages.singular')]));
            return redirect(route('admin.packages.index'));
        }

        return view('admin.packages.show')->with('package', $package);
    }
}
