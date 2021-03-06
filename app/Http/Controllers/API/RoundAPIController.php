<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTripOrderAPIRequest;
use App\Http\Requests\API\UpdateTripOrderAPIRequest;
use App\Models\TripOrder;
use App\Repositories\TripOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Controllers\User\cartController;
use App\Models\Trip;
use App\Models\Notification;
use App\Models\Coupon;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;
use DB;

/**
 * Class TripOrderController
 * @trip App\Http\Controllers\API
 */

class RoundAPIController extends AppBaseController
{
    /** @var  TripOrderRepository */
    private $tripOrderRepository;

    public function __construct(TripOrderRepository $tripOrderRepo)
    {
        $this->tripOrderRepository = $tripOrderRepo;
    }

    /**
     * Display a listing of the TripOrder.
     * GET|HEAD /tripOrders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $tripOrders = $this->tripOrderRepository->all(
            array_merge([
                'user_id' => $user->id,
                'user_archive' => 0,
                'type' => 'round'
            ], $request->except(['skip', 'limit'])),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $tripOrders->toArray(),
            __('messages.retrieved', ['model' => __('models/tripOrders.plural')])
        );
    }

    /**
     * Store a newly created TripOrder in storage.
     * POST /tripOrders
     *
     * @param CreateTripOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $trips = $request->trips;
            $tripsOrders = [];
            $counter = 0;
            $prev_trip_order_id =0;
            foreach($trips ?? [] as $i => $trip) {
                $counter++;
                $trip['user_id'] = $user->id;
                $trip['type'] = 'round';

                $request = new Request($trip);
                $trip = cartController::buildTheRequest($request);

                if($counter>1){
                    //prev_trip_order_id
                    $trip['prev_trip_order_id'] = $prev_trip_order_id;
                }

                $response = app('App\Http\Controllers\User\TripOrderController')->saveTripOrder($trip);
                $response = $response->getData();
                if(!$response->success) {
                    return $this->sendError($response->message);
                }

                $tripOrder = $response->tripOrder;
                $prev_trip_order_id = $tripOrder->id;
                $tripsOrders[] = $tripOrder;

                if(isset($trips[$i+1])) $trips[$i+1]['prev_trip_order_id'] = $tripOrder->id;
            }
            DB::commit();
            return $this->successResponse(
                ['message' =>  __('messages.saved', ['model' => __('models/tripOrders.singular')])],
                __('messages.saved', ['model' => __('models/tripOrders.singular')])
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified TripOrder.
     * GET|HEAD /tripOrders/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();

        /** @var TripOrder $tripOrder */
        $tripOrder = $this->tripOrderRepository->find($id);
        if (empty($tripOrder) || $tripOrder->user_id != $user->id) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tripOrders.singular')])
            );
        }

        $tripOrder->additionals = $tripOrder->additionals();
        $tripOrder->trip = $tripOrder->trip;
        $tripOrder->additional_fees = $tripOrder->additional_fees;
        $tripOrder->tickets = $tripOrder->tickets;
        $tripOrder->discount = $tripOrder->discount;
        $tripOrder->destination = (!is_null($tripOrder->trip) ? $tripOrder->trip->destinations : null);

        return $this->sendResponse(
            $tripOrder->toArray(),
            __('messages.retrieved', ['model' => __('models/tripOrders.singular')])
        );
    }

    /**
     * Update the specified TripOrder in storage.
     * PUT/PATCH /tripOrders/{id}
     *
     * @param int $id
     * @param UpdateTripOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTripOrderAPIRequest $request)
    {
        $user = Auth::user();

        $tripOrder = $this->tripOrderRepository->find($id);

        if (empty($tripOrder) || $tripOrder->user_id != $user->id) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tripOrders.singular')])
            );
        }

        if (!in_array($tripOrder->status, ['pending', 'approved'])) {
            return $this->sendError(__('msg.unauthorized'));
        }

        DB::beginTransaction();

        if(is_null($user_notes = $request->user_notes)) {
            return $this->sendError(__('validation.required', ['attribute' => __('models/tripOrders.fields.user_notes')]));
        }

        $input = [
            'status' => 'canceled',
            'user_notes' => $user_notes
        ];

        $tripOrder = $this->tripOrderRepository->update($input, $id);

        // send notification to the user
        $notification = Notification::create([
            'title' => 'Order #' . $tripOrder->id,
            'text' => "The order is " . __('models/tripOrders.status.'.$tripOrder->status) .  ", please click to check more details.",
            'url' => route('provider.tripOrders.show', $tripOrder->id),
            'icon' => 'ti-close',
            'type' => 'danger',
            'to' => 'provider',
            'provider_id' => $tripOrder->provider_id
        ]);

        DB::commit();

        return $this->sendResponse(
            $tripOrder->toArray(),
            __('messages.updated', ['model' => __('models/tripOrders.singular')])
        );
    }

    /**
     * Remove the specified TripOrder from storage.
     * DELETE /tripOrders/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        /** @var TripOrder $tripOrder */
        $tripOrder = $this->tripOrderRepository->find($id);

        if (empty($tripOrder) || $user->id != $tripOrder->user_id) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tripOrders.singular')])
            );
        }

        $this->tripOrderRepository->update(['user_archive' => 1], $id);

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/tripOrders.singular')])
        );
    }
}
