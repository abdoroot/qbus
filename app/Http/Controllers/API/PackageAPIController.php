<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePackageAPIRequest;
use App\Http\Requests\API\UpdatePackageAPIRequest;
use App\Models\Package;
use App\Repositories\PackageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PackageController
 * @package App\Http\Controllers\API
 */

class PackageAPIController extends AppBaseController
{
    /** @var  PackageRepository */
    private $packageRepository;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepository = $packageRepo;
    }

    /**
     * Display a listing of the Package.
     * GET|HEAD /packages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $packages = $this->packageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $packages->toArray(),
            __('messages.retrieved', ['model' => __('models/packages.plural')])
        );
    }

    /**
     * Store a newly created Package in storage.
     * POST /packages
     *
     * @param CreatePackageAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePackageAPIRequest $request)
    {
        $input = $request->all();

        $package = $this->packageRepository->create($input);

        return $this->sendResponse(
            $package->toArray(),
            __('messages.saved', ['model' => __('models/packages.singular')])
        );
    }

    /**
     * Display the specified Package.
     * GET|HEAD /packages/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Package $package */
        $package = $this->packageRepository->find($id);

        if (empty($package)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packages.singular')])
            );
        }

        return $this->sendResponse(
            $package->toArray(),
            __('messages.retrieved', ['model' => __('models/packages.singular')])
        );
    }

    /**
     * Update the specified Package in storage.
     * PUT/PATCH /packages/{id}
     *
     * @param int $id
     * @param UpdatePackageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackageAPIRequest $request)
    {
        $input = $request->all();

        /** @var Package $package */
        $package = $this->packageRepository->find($id);

        if (empty($package)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packages.singular')])
            );
        }

        $package = $this->packageRepository->update($input, $id);

        return $this->sendResponse(
            $package->toArray(),
            __('messages.updated', ['model' => __('models/packages.singular')])
        );
    }

    /**
     * Remove the specified Package from storage.
     * DELETE /packages/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Package $package */
        $package = $this->packageRepository->find($id);

        if (empty($package)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packages.singular')])
            );
        }

        $package->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/packages.singular')])
        );
    }
}
