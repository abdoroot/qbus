<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\CreateBusOrderRequest;
use App\Http\Requests\UpdateBusOrderRequest;
use App\Repositories\BusOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\City;
use App\Models\Bus;
use App\Models\Destination;
use App\Models\BusDatetime;
use App\Models\Notification;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;
use DB;
use TapPayment;

class BusOrderController extends AppBaseController
{
    /** @var BusOrderRepository $busOrderRepository*/
    private $busOrderRepository;

    public function __construct(BusOrderRepository $busOrderRepo)
    {
        $this->busOrderRepository = $busOrderRepo;
        $this->middleware(function ($request, $next) {
            $this->id = Auth::check() ? Auth::user()->id : null;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the BusOrder.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $busOrders = $this->busOrderRepository->all(['user_id' => $this->id])->paginate(10);

        return view('user.bus_orders.index')
            ->with('busOrders', $busOrders);
    }

    /**
     * Show the form for creating a new BusOrder.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::pluck('name', 'id');

        return view('user.bus_orders.create')
            ->with('cities', $cities);
    }

    /**
     * Store a newly created BusOrder in storage.
     *
     * @param CreateBusOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateBusOrderRequest $request)
    {
        DB::beginTransaction();

        $fees = app('\App\Http\Controllers\API\ProviderAPIController')->getFees($request->provider_id, $request->destination);
        $data = $fees->getData();
        $bus_fees = $data->data->bus_fees;

        $input = array_merge([
            'user_id' => $this->id,
            'fees'   => $bus_fees,
            'tax' => $tax = ($bus_fees * (!is_null($provider = Provider::find($request->provider_id)) ? $provider->tax : 0) / 100),
            'total' => $bus_fees + $tax,
            'status' => $bus_fees ? 'approved' : 'pending',
        ], $request->only(
            'lat',
            'lng',
            'zoom',
            'date_from',
            'time_from',
            'date_to',
            'time_to',
            'destination',
            'provider_id',
            'bus_id',
            'user_notes'
        ));

        // store busOrder
        $busOrder = $this->busOrderRepository->create($input);

        // store busOrder Datetimes (only if approved)
        if($busOrder->status == 'approved') {
            $date = Carbon::parse($busOrder->date_from);
            while ($date->lte(Carbon::parse($busOrder->date_to))) {
                BusDatetime::create([
                    'bus_order_id' => $busOrder->id,
                    'bus_id' => $busOrder->bus_id,
                    'date' => $date->format('Y-m-d'),
                    'time_from' => $busOrder->time_from,
                    'time_to' => $busOrder->time_to,
                ]);

                $date = $date->addDay();
            }
        }

        // send notification to the provider
        $user_name = $busOrder->user->name;
        $notification = Notification::create([
            'title' => 'New bus order #' . $busOrder->id,
            'text' => "A new order has just been created by user <b> $user_name </b>, 
                order is " . __('models/busOrders.status.'.$busOrder->status) . ", please click to check more details.",
            'url' => route('provider.busOrders.show', $busOrder->id),
            'icon' => 'ti-truck',
            'type' => 'primary',
            'to' => 'provider',
            'provider_id' => $busOrder->provider_id
        ]);

        // send notification to the user
        $notification = Notification::create([
            'title' => 'Order #' . $busOrder->id,
            'text' => "Your order has been created successfully, 
                order is " . __('models/busOrders.status.'.$busOrder->status) . ", please click to check more details.",
            'url' => route('busOrders.show', $busOrder->id),
            'icon' => 'ti-truck',
            'type' => 'primary',
            'to' => 'user',
            'user_id' => $busOrder->user_id
        ]);

        DB::commit();

        $flash_message = __('messages.saved', ['model' => __('models/busOrders.singular')]);

        if($busOrder->status == 'approved') {
            $flash_message .= ", " . __('msg.please_do_the_payment_and_complete_the_order');
            Flash::success($flash_message);
            return redirect(route('busOrders.payment', $busOrder->id));
        }

        $flash_message .= ", " . __('msg.please_wait_for_provider_approval_to_do_the_payment_and_complete_the_order');
        Flash::success($flash_message);
        return redirect(route('busOrders.index'));
    }

    /**
     * Display the specified BusOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Request $request)
    {
        $busOrder = $this->busOrderRepository->find($id);
        if (empty($busOrder) || $busOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('busOrders.index'));
        }

        return view('user.bus_orders.show')
            ->with('busOrder', $busOrder)
            ->with('active', $request->active);
    }

    /**
     * Update the specified BusOrder in storage.
     *
     * @param int $id
     * @param UpdateBusOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBusOrderRequest $request)
    {
        $busOrder = $this->busOrderRepository->find($id);

        if (empty($busOrder) || $busOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('busOrders.index'));
        }

        if (!in_array($busOrder->status, ['pending', 'approved'])) {
            Flash::error(__('msg.unauthorized'));
            return redirect(route('busOrders.index'));
        }

        DB::beginTransaction();

        if(is_null($user_notes = $request->user_notes)) {
            return redirect()->back()->withErrors([
                'user_notes' => __('validation.required', ['attribute' => __('models/busOrders.fields.user_notes')])
            ]);
        }

        $input = [
            'status' => 'canceled',
            'user_notes' => $user_notes
        ];

        $busOrder = $this->busOrderRepository->update($input, $id);

        // send notification to the user
        $notification = Notification::create([
            'title' => 'Order #' . $busOrder->id,
            'text' => "The order is " . __('models/busOrders.status.'.$busOrder->status) .  ", please click to check more details.",
            'url' => route('provider.busOrders.show', $busOrder->id),
            'icon' => 'ti-close',
            'type' => 'danger',
            'to' => 'provider',
            'provider_id' => $busOrder->provider_id
        ]);

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/busOrders.singular')]));
        return redirect(route('busOrders.index'));
    }

    /**
     * Remove the specified BusOrder from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $busOrder = $this->busOrderRepository->find($id);

        if (empty($busOrder) || $busOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('busOrders.index'));
        }

        $this->busOrderRepository->update(['user_archive' => 1], $id);

        Flash::success(__('messages.deleted', ['model' => __('models/busOrders.singular')]));
        return redirect(route('busOrders.index'));
    }

    public function payment($id, Request $request)
    {
        $busOrder = $this->busOrderRepository->find($id);
        if (empty($busOrder) || $busOrder->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/busOrders.singular')]));
            return redirect(route('busOrders.index'));
        }
        if($busOrder->status != 'approved') {
            Flash::error(__('msg.the_payment_link_is_not_valid'));
            return redirect(route('busOrders.index'));
        }

        $user = $busOrder->user;

        try {

            $data = 
            [
                "amount" => 1,
                "currency" => "KWD",
                "threeDSecure" => true,
                "save_card" => false,
                "description" => "Bus order #$id",
                "statement_descriptor" => "Sample",
                "metadata" => [],
                "reference" => [
                    "transaction" => "txn_0001",
                    "order" => "ord_$id"
                ],
                "receipt" => [
                    "email" => false,
                    "sms" => true
                ],
                "customer" =>  [
                    "first_name" => $user->name,
                    "email" => $user->email,
                    "phone" => [
                        "country_code" => "966",
                        "number" => $user->phone
                    ]
                ],
                "merchant" => ["id" => ""],
                "source" =>["id" => "src_kw.knet"],
                "post" => ["url" => route('busOrders.payment', $id)],
                "redirect" => ["url" => route('busOrders.show', $id)]
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.tap.company/v2/charges",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer sk_test_atl8y2ETdzjUXRVhiwNH0nCu",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            }
            
            $response = json_decode($response, true);
            $transaction = $response['transaction'];

            return redirect($transaction['url']);
            
        } catch( \Exception $exception ) {
            // your handling of request failure
            Flash::error(__('msg.something_went_wrong_while_proceeding_the_payment') . ', ' . $exception->getMessage());
            return redirect()->back();
        }
    }
}
