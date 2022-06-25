<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Session;

class cartController extends Controller
{
    public function index(Request $request)
    {
        $cart = Session::get('cart') ?? [];

        $trips = [];
        $fees = 0;
        $additional_fees = 0;
        $total = 0;

        foreach($cart as $item) {
            if(!is_null($trip = Trip::find(isset($item['trip_id']) ? $item['trip_id'] : null))) {
                $tot_fees = $item['count'] * $trip->fees;
                $trip->tot_fees = $tot_fees;
                $fees += $tot_fees;
                if(!empty($additional = $item['additional'])) {
                    $add_fees = array_sum(array_map(function($it) { return $it['fees'] * $it['count']; }, $additional));
                    $trip->add_fees = $add_fees;
                    $additional_fees += $add_fees;
                }
                $trips[] = $trip;
            }
        }

        $total = $fees + $additional_fees;

        return view('user.cart.index')
            ->with('cart', $cart)
            ->with('trips', $trips)
            ->with('fees', $fees)
            ->with('additional_fees', $additional_fees)
            ->with('total', $total);
    }
    public static function isAddedBefore($tripId){

        $cart = Session::get('cart');
        //dd($cart);
        if(is_array($cart)){
            foreach ($cart as $key => $value){
                if($value['trip_id'] == $tripId){
                    return true;
                }
            }
        }
        return false;
    }

    public static function buildTheRequest($request)
    {
        $trip = Trip::find($request->trip_id);

        $coupon = Coupon::where([
                'code' => $request->code,
                'provider_id' => $trip->provider_id,
                'status' => 'approved',
            ])
            ->where('date_from', '<=', $today = Carbon::now()->toDateString())
            ->where('date_to', '>=', $today)
            ->first();

        $additionalFees = 0;
        $additional = [];
        $tripAdditional = $trip->additional;

        foreach ($request->additional ?? [] as $additional_id) {
            $filter = array_filter($tripAdditional, function ($addition) use ($additional_id)
            {
                return $addition['id'] == $additional_id;
            });

            if(is_null($filter)) continue;

            $filter = array_shift($filter);
            $count = (isset($request->additional_count[$filter['id']]) ? $request->additional_count[$filter['id']] : 1);
            $additionFees = $filter['fees'] * $count;

            $additional[] = ['id' => (int)$additional_id, 'fees' => (float)$additionFees, 'count' => (int)$count];
            $additionalFees += $additionFees;
        }

        $input = array_merge($request->only('user_id', 'trip_id', 'count', 'user_notes', 'type', 'prev_trip_order_id'), [
            'provider_id' => $trip->provider_id,
            'fees' => $fees = $trip->fees * $request->count,
            'tax' => $tax = ($fees * (!is_null($provider = $trip->provider) ? $provider->tax : 0) / 100),
            'coupon_id' => !is_null($coupon) ? $coupon->id : null,
            'total' => is_null($coupon)
                ? $fees + $tax + $additionalFees
                : ($total = $fees + $tax + $additionalFees) - ($coupon->type == 'amount' ? $coupon->discount : ($total * $coupon->discount / 100)),
            'status' => 'approved', // $request->type == 'one-way' ? 'approved' : 'pending', // $trip->auto_approve ? 'approved' : 'pending',
            'additional' => json_decode(json_encode($additional),true)
        ]);

        return $input;
    }

    public static function add(Request $request){

        $input = cartController::buildTheRequest($request);

        $tripId  = $input['trip_id'];

        //search for the trip if already added
        if(!cartController::isAddedBefore($tripId)){
            //add to session
            Session::push("cart",$input);
            //dd('added');
        }else{
            //update the session
            cartController::update($tripId,$input);
        }

        return true;
    }

    public static function update($tripId,array $product)
    {
        if(cartController::isAddedBefore($tripId)){
            //update
            $cart = Session::get('cart');
            //$cart = cartController::toArray($cart);
            //dd($cart);
            if(is_array($cart)){
                foreach ($cart as $key => $value){
                    //$value = $value->toArray();
                    if($value['trip_id'] == $tripId){
                        //update count
                        $cart[$key]['count'] += $product['count'];
                        if(is_array($value['additional']) && count($value['additional']) >0 ){
                            //try to update additional
                            foreach ($value['additional'] as $cKey => $cValue){
                                //looping cart additional first
                                $cValue = (array)$cValue;
                                foreach ((array)$product['additional'] as $pKey => $pValue){
                                    //looping product additional second
                                    $notFound = true;
                                    $pValue = (array)$pValue;
                                    //dd((array)$cValue);
                                    if($cValue['id'] == $pValue['id']){
                                        $notFound = false;
                                        $cart[$key]['additional'][$cKey]['count'] += (int)$pValue['count'];
                                        //dd($cart);
                                    }
                                }
                            }
                            if($notFound){
                                //push the new additional
                                //dd($product['additional'][$pKey]);
                                array_push($cart[$key]['additional'],$product['additional'][$pKey]);
                            }

                        }else if(is_array($value['additional']) && count($value['additional']) == 0) {
                            //todo add new additional
                            foreach ($product['additional'] as $pKey => $pValue){
                                array_push($cart[$key]['additional'],$product['additional'][$pKey]);
                            }
                        }

                    }
                }
                //forget old cart
                Session::forget("cart") ;
                //update cart session
                Session::put("cart",$cart);
            }
        }
    }

    public function removeTrip($tripId){
        if(cartController::isAddedBefore($tripId)){
            //remove
            $cart = Session::get('cart');
            if(is_array($cart)){
                foreach ($cart as $key => $value){
                    //$value = $value->toArray();
                    if($value['trip_id'] == $tripId){
                        unset($cart[$key]);
                        //forget old cart
                        Session::forget("cart") ;
                        //update cart session
                        Session::put("cart",$cart);
                    }
                }
            }
        }
    }

    public function removeFromCart($tripId)
    {
        $this->removeTrip($tripId);
        return redirect()->route('cart');
    }

    public function clear(){
        Session::forget("cart") ;
        return redirect(route('home'));
    }

    public function store()
    {
        return "redirecting to payment gateway ...";
        $cart = Session::get('cart');

        foreach($cart as $i => $item) {
            $response = app('App\Http\Controllers\User\TripOrderController')->saveTripOrder($item);
            $response = $response->getData();
            if(!$response->success) {
                Flash::error($response->message);
                return redirect()->back()->withInput();
            }

            $tripOrder = $response->tripOrder;

            if(isset($cart[$i+1])) $cart[$i+1]['prev_trip_order_id'] = $tripOrder->id;
        }

        $this->clear();

        return redirect()->route('cartPayment');
    }

    public function payment()
    {
        return "redirecting to payment gateway ...";
    }
}
