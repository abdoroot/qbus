<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Carbon\Carbon;
use Flash;
use Mail;
use Str;
use DB;

class PasswordPhoneController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset phones and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRequestForm()
    {
        return view('auth.passwords.phone');
    }

    public function sendResetCodePhone(Request $request)
    {
        $request->validate(['phone' => 'required']);

        if(is_null($user = User::where('phone', $request->phone)->first())) {
            Flash::error(__('passwords.user_phone'));
            return redirect()->back();
        }

        $token = Str::random(6);

        DB::table('password_resets')->where(['email'=> $user->phone])->delete();

        DB::table('password_resets')->insert([
            'email' => $user->phone, 
            'token' => $token, 
            'created_at' => Carbon::now()
            ]);

        $send = app('App\Http\Controllers\Auth\VerifyPhoneController')->send($user->id);
        $response = $send->getData();
        if(!$response->success) {
            Flash::error($response->message);
            return redirect()->back();
        }
        
        Flash::success($response->message);
        return redirect()->route('phone.reset');
    }
}
