<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\API\CreateBusOrderAPIRequest;
use App\Http\Requests\API\UpdateBusOrderAPIRequest;
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
    public function store(CreateBusOrderAPIRequest $request)
    {
        $request = app('App\Http\Controllers\API\BusOrderAPIController')->store($request);
        $response = $request->getData();
        if(!$response->success) {
            Flash::error($response->message);
            return redirect()->back();
        }

        Flash::success($response->message);
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
        $request = app('App\Http\Controllers\API\BusOrderAPIController')->show($id);
        $response = $request->getData(); dd($response);

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
    public function update($id, UpdateBusOrderAPIRequest $request)
    {
        if(is_null($request->user_notes)) {
            return redirect()->back()->withErrors([
                'user_notes' => $response->message
            ]);
        }

        $request = app('App\Http\Controllers\API\BusOrderAPIController')->update($id, $request);
        $response = $request->getData(); 
        if(!$response->success) {
            Flash::error($response->message);
            return redirect()->route('busOrders.index');
        }

        Flash::success($response->message);
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
        $request = app('App\Http\Controllers\API\BusOrderAPIController')->destroy($id);
        $response = $request->getData(); 
        if(!$response->success) {
            Flash::error($response->message);
            return redirect()->route('busOrders.index');
        }

        Flash::success($response->message);
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
