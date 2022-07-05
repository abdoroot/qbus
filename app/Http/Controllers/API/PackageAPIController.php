<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePackageAPIRequest;
use App\Http\Requests\API\UpdatePackageAPIRequest;
use App\Models\Additional;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Destination;
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
        $imagesUrl = asset('images/packages/');
        $array = [
            'message' => $message,
            'code' => $code,
        ];
        if($data != "" && $code == 1){
            $arrayData = @json_decode(json_encode($data), true);
            //$arrayData = array_values($arrayData);
            foreach($arrayData as $key => $value){
                if(is_array($value)){
                    foreach($value as $k2 => $v2){
                        if(is_array($v2)){
                            foreach($v2 as $k3 => $v3){
                                if(is_null($v3)){
                                    $arrayData[$key][$k2][$k3] = "";
                                }else{
                                    //Not null v3
                                    if(is_array($v3)){
                                        foreach($v3 as $k4 => $v4){
                                            if(is_null($v4)){
                                                $arrayData[$key][$k2][$k3][$k4] = "";
                                            }
                                        }


                                        //print_r($newAdditional);

                                    }
                                }
                            }
                        }


                        if(is_array($arrayData[$key][$k2]['additional'])){
                            $newAdditional = [];
                            foreach ($arrayData[$key][$k2]['additional'] as $ak => $av){
                                array_push($newAdditional,['id' => $av['id'],'fees' => $av['fees']]);
                            }
                            $arrayData[$key][$k2]['additional'] = $newAdditional;
                        }
                    }
                }else{
                    //empty
                    //$arrayData = [[]];
                }

            }
            $arrayData['image_base'] = $imagesUrl;
            $array['data'] = $arrayData;
        }
        else{
            $array['data'] = ['message' => "no data found"] ;
        }
        return $array;
    }

    public function index(Request $request)
    {
        $query = "";

        $limit = 8;

        if($request->offset){
            $offset = $request->offset;
            if($offset == 1){
                $offset = 0;
            }else{
                $offset = ($offset-1) * $limit;
            }
        }else{
            $offset = 0;
        };

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

        //$paginator = $paginator->select('packages.*')->paginate($limit);
        $paginator = $paginator->select('packages.*')->limit($limit)->offset($offset)->get();

        //dd($paginator);

        $cities = City::pluck('name', 'id');
        $additionals = Additional::get();

        if(count($paginator ) > 0) {
            return response()->json($this->ReturnJson("success", ['packages' => $paginator], 1), 200);
        }else{
            return response()->json($this->ReturnJson("no data found", ['packages' => []], 0), 400);
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
        $imagesUrl = asset('images/packages/');
        $package =  Package::where('packages.id',$id);
        $package->join('cities','cities.id', '=', 'packages.starting_city_id');
        $package->select(
          "packages.id",
          "packages.provider_id",
          "packages.name",
          "packages.date_from",
          "packages.time_from",
          "packages.description",
          "packages.image",
          "packages.destinations",
          "packages.fees",
          'cities.name as start_station_name',
          "packages.additional",//removed after used
          "packages.rate"
            );


        $package = $package->first()->toArray();



        if (empty($package)) {
            $array = [
                'message' => __('messages.not_found', ['model' => __('models/packages.singular')]),
                'code' => 0,
                'data' => ['message' =>  __('messages.not_found', ['model' => __('models/packages.singular')])]
            ];
            return response()->json($array, 400);
        }

        //handle additionals
        $additional = [];
         if(count($package['additional']) > 0){
              foreach ($package['additional'] as $adKey => $adValue){
                $additionalInfo = Additional::where('id',$adValue['id'])->get()->first()->toArray();

                if(!array_key_exists('ur',$additionalInfo['name'])){
                    $additionalInfo['name']['ur'] = $additionalInfo['name']['en'];
                }

                    array_push($additional,[
                        'id' => $additionalInfo['id'],
                        'fees' => (float)$adValue['fees'],
                        'name' =>  $additionalInfo['name']
                  ]);
              }
         }
        $package['additionals'] = $additional;
        unset($package['additional']);


        //handle destinations
        $destinations = [];
        if(count($package['destinations']) > 0){
            foreach ($package['destinations'] as $adKey => $adValue){
                $destinationInfo = Destination::where('id',$adValue)->first()->toArray();
                //dd($destinationInfo);
                array_push($destinations,$destinationInfo);
            }
        }
        unset($package['destinations']);
        $package['destinations'] = $destinations;


        $array = [
            'message' => __('messages.success', ['model' => __('models/packages.singular')]),
            'code' => 1,
            'data' => ['packages' => $package,'image_base' => $imagesUrl]
        ];
        return response()->json($array, 200);
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
