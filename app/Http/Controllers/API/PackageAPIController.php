<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePackageAPIRequest;
use App\Http\Requests\API\UpdatePackageAPIRequest;
use App\Models\Additional;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Package;
use App\Repositories\PackageRepository;
use Carbon\Carbon;
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

    public function index(Request $request)
    {
        $query = "";
        $limit = 6;
        $today = Carbon::now();
        $paginator = new Package;

        if(!is_null($search = $request->search)) {
            //$query .= "&search={$request->search}";
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
            //$query .= "&date_from={$request->date_from}";
            $paginator = $paginator->where('date_from', '>=', $date_from);
        }
        if(!is_null($time_from = $request->time_from)) {
            //$query .= "&time_from={$request->time_from}";
            $paginator = $paginator->where('time_from', '>=', $time_from);
        }
        if(!is_null($starting_city_id = $request->starting_city_id)) {
            //$query .= "&starting_city_id={$request->starting_city_id}";
            $paginator = $paginator->where('starting_city_id', $starting_city_id);
        }

        if(!is_null($code = $request->code)) {
            //$query .= "&code={$request->code}";
            $provider_id = null;
            $coupon = Coupon::where(['code' => $request->code, 'status' => 'approved'])
                ->where('date_from', '>=', $today = Carbon::now()->toDateString())
                ->where('date_to', '>=', $today)
                ->first();
            if(!is_null($coupon)) $provider_id = $coupon->provider_id;

            $paginator = $paginator->where('packages.provider_id', $provider_id);
        }

        $paginator = $paginator->select('packages.*')->paginate($limit);

        $cities = City::pluck('name', 'id');
        $additionals = Additional::get();

        if(count($paginator->items() ) > 0) {
            return response()->json($this->ReturnJson("success", ['packages' => $paginator->items()], 1), 200);
        }else{
            return response()->json($this->ReturnJson("no data found", ['packages' => ''], 0), 400);
        }
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

    /**
     * Get the specified Package Additionals.
     * GET|HEAD /packages/get-additionals
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getAdditionals(Request $request)
    {
        /** @var Package $package */
        $package = $this->packageRepository->find($request->package_id);
        if (empty($package)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/packages.singular')])
            );
        }

        return $this->sendResponse(
            $package->additionals(),
            __('messages.retrieved', ['model' => __('models/packages.singular')])
        );
    }
}
