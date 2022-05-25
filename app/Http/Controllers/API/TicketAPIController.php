<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTicketAPIRequest;
use App\Http\Requests\API\UpdateTicketAPIRequest;
use App\Models\Ticket;
use App\Models\TripOrder;
use App\Models\PackageOrder;
use App\Repositories\TicketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use DB;

/**
 * Class TicketController
 * @package App\Http\Controllers\API
 */

class TicketAPIController extends AppBaseController
{
    /** @var  TicketRepository */
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepo)
    {
        $this->ticketRepository = $ticketRepo;
    }

    /**
     * Display a listing of the Ticket.
     * GET|HEAD /tickets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tickets = $this->ticketRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $tickets->toArray(),
            __('messages.retrieved', ['model' => __('models/tickets.plural')])
        );
    }

    /**
     * Store a newly created Ticket in storage.
     * POST /tickets
     *
     * @param CreateTicketAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTicketAPIRequest $request)
    {
        if($request->type == 'trip') {
            $tripOrder = TripOrder::find($request->trip_order_id);
            if (is_null($trip = $tripOrder->trip)) {
                return $this->sendError(
                    __('messages.not_found', ['model' => __('models/trips.singular')])
                );
            }

            DB::beginTransaction();

            $count = 0;
            $seatNum = 1;
            while($count < $tripOrder->count && $seatNum <= $trip->max) {
                if(is_null($ticket = Ticket::join('trip_orders', 'trip_orders.id', '=', 'tickets.trip_order_id')
                    ->where(['trip_id' => $trip->id, 'seat_num' => $seatNum])->select('tickets.*')->first())) {
                    $ticket = $this->ticketRepository->create([
                        'trip_order_id' => $tripOrder->id,
                        'seat_num' => $seatNum,
                    ]);

                    $count++;
                }
                $seatNum++;
            }
            
            if($count < $tripOrder->count) {
                DB::rollback();
                return $this->sendError(__('msg.this_number_of_tickets_are_not_available'));
            }

            DB::commit();

            return $this->sendResponse(
                $ticket->toArray(),
                __('messages.saved', ['model' => __('models/tickets.singular')])
            );
        } else {
            $packageOrder = PackageOrder::find($request->package_order_id);

            DB::beginTransaction();

            $count = 0;
            $seatNum = 1;
            while($count < $packageOrder->count) { //  && $seatNum <= $package->max
                if(is_null($ticket = Ticket::join('package_orders', 'package_orders.id', '=', 'tickets.package_order_id')
                    ->where(['package_id' => $packageOrder->package_id, 'seat_num' => $seatNum])->select('tickets.*')->first())) {
                    $ticket = $this->ticketRepository->create([
                        'package_order_id' => $packageOrder->id,
                        'seat_num' => $seatNum,
                    ]);

                    $count++;
                }
                $seatNum++;
            }
            
            if($count < $packageOrder->count) {
                DB::rollback();
                return $this->sendError(__('msg.this_number_of_tickets_are_not_available'));
            }

            DB::commit();

            return $this->sendResponse(
                $ticket->toArray(),
                __('messages.saved', ['model' => __('models/tickets.singular')])
            );
        }
        
    }

    /**
     * Display the specified Ticket.
     * GET|HEAD /tickets/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Ticket $ticket */
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tickets.singular')])
            );
        }

        return $this->sendResponse(
            $ticket->toArray(),
            __('messages.retrieved', ['model' => __('models/tickets.singular')])
        );
    }

    /**
     * Update the specified Ticket in storage.
     * PUT/PATCH /tickets/{id}
     *
     * @param int $id
     * @param UpdateTicketAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTicketAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ticket $ticket */
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tickets.singular')])
            );
        }

        $ticket = $this->ticketRepository->update($input, $id);

        return $this->sendResponse(
            $ticket->toArray(),
            __('messages.updated', ['model' => __('models/tickets.singular')])
        );
    }

    /**
     * Remove the specified Ticket from storage.
     * DELETE /tickets/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Ticket $ticket */
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tickets.singular')])
            );
        }

        $ticket->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/tickets.singular')])
        );
    }
}
