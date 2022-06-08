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
    public function isAddedBefore($tripId){

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

    public function buildTheRequest($request){

        $trip = Trip::find($request->trip_id);

        $additional = [];

        $tripAdditional = $trip->additional;

        $coupon = Coupon::where([
            'code' => $request->code,
            'provider_id' => $trip->provider_id,
            'status' => 'approved',
        ])
            ->where('date_from', '<=', $today = Carbon::now()->toDateString())
            ->where('date_to', '>=', $today)
            ->first();

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
        }

        $product =  array_merge($request->only('trip_id', 'count', 'user_notes', 'type', 'prev_trip_order_id'), [
            'fees' => $fees = $trip->fees * $request->count,
            'coupon_id' => !is_null($coupon) ? $coupon->id : null,
            'additional' => json_decode(json_encode($additional),true)
        ]);

        return $product;
    }

    public function add(Request $request){

        $product = cartController::buildTheRequest($request);

        $tripId     = $product['trip_id'];

        //search for the trip if already added
        if(!cartController::isAddedBefore($tripId)){
            //add to session
            Session::push("cart",$product);
            //dd('added');
        }else{
            //update the session
            cartController::update($tripId,$product);
        }
    }

    public function update($tripId,array $product)
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

    public function clear(){
        Session::forget("cart") ;
        return redirect(route('home'));
    }
}
