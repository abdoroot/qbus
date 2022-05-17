<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProviderAPIRequest;
use App\Http\Requests\API\UpdateProviderAPIRequest;
use App\Models\Provider;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Package;
use App\Models\Destination;
use Response;

/**
 * Class ProviderController
 * @package App\Http\Controllers\API
 */

class ProviderAPIController extends AppBaseController
{
    /** @var  ProviderRepository */
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
    }

    /**
     * Display a listing of the Provider.
     * GET|HEAD /providers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $providers = $this->providerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        if(isset($request->destination) && is_array($destination = $request->destination)) {
            foreach ($providers as $provider) {
                $fees = $this->getFees($provider->id, $destination);
                $data = $fees->getData();
                $provider->bus_fees = $data->data->bus_fees;
            }
        }

        return $this->sendResponse(
            $providers->toArray(),
            __('messages.retrieved', ['model' => __('models/providers.plural')])
        );
    }

    /**
     * Store a newly created Provider in storage.
     * POST /providers
     *
     * @param CreateProviderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProviderAPIRequest $request)
    {
        $input = $request->all();

        $provider = $this->providerRepository->create($input);

        return $this->sendResponse(
            $provider->toArray(),
            __('messages.saved', ['model' => __('models/providers.singular')])
        );
    }

    /**
     * Display the specified Provider.
     * GET|HEAD /providers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Provider $provider */
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/providers.singular')])
            );
        }

        return $this->sendResponse(
            $provider->toArray(),
            __('messages.retrieved', ['model' => __('models/providers.singular')])
        );
    }

    /**
     * Update the specified Provider in storage.
     * PUT/PATCH /providers/{id}
     *
     * @param int $id
     * @param UpdateProviderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProviderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Provider $provider */
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/providers.singular')])
            );
        }

        $provider = $this->providerRepository->update($input, $id);

        return $this->sendResponse(
            $provider->toArray(),
            __('messages.updated', ['model' => __('models/providers.singular')])
        );
    }

    /**
     * Remove the specified Provider from storage.
     * DELETE /providers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Provider $provider */
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/providers.singular')])
            );
        }

        $provider->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/providers.singular')])
        );
    }

    public function getFees($provider_id, $destination)
    {
        // $destination = !is_array($destination) ? explode(',', $destination) : $destination;
        // if(!is_null($package = Package::where([
        //         'provider_id'=> $provider_id,
        //         'cities' => $destination,
        //     ])->first())) 
        // {
        //     return $this->sendResponse(
        //         ['bus_fees' => $package->bus_fees],
        //         __('messages.retrieved', ['model' => __('models/destinations.fields.bus_fees')])
        //     );
        // }

        // $bus_fees = 0;
        // $passenger_fees = 0;
        // foreach($destination as $key => $city_id) {
        //     if($key == 0) {
        //         $from_city_id = $city_id;
        //         continue;
        //     }
            
        //     if(is_null($destination = Destination::where([
        //         'provider_id' => $provider_id,
        //         'from_city_id' => $from_city_id,
        //         'to_city_id' => $city_id
        //     ])->first())) 
        //     {
        //         return $this->sendResponse(
        //             ['bus_fees' => null, 'passenger_fees' => null],
        //             __('messages.not_found', ['model' => __('models/destinations.fields.bus_fees')])
        //         );
        //     }
        //     $bus_fees += $destination->bus_fees;
        //     $passenger_fees += $destination->passenger_fees;
        //     $from_city_id = $city_id;
        // }

        $bus_fees = null;
        $passenger_fees = null;
        
        return $this->sendResponse(
            ['bus_fees' => $bus_fees, 'passenger_fees' => $passenger_fees],
            __('messages.retrieved', ['model' => __('models/destinations.fields.bus_fees')])
        );
    }
}
