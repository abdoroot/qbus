<?php

namespace App\Http\Controllers\Provider\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Provider;
use App\Models\Account;
use Carbon\Carbon;
use Flash;
use Mail;
use Str;
use DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
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
        $this->middleware('guest:provider');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('provider.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if(is_null($account = Account::where('email', $request->email)->first())) {
            Flash::error(__('passwords.user'));
            return redirect()->back();
        }

        $token = Str::random(64);

        DB::table('password_resets')->where(['email'=> $account->email])->delete();

        DB::table('password_resets')->insert([
            'email' => $account->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
            ]);

        Mail::send('emails.password', [
            'link' => route('provider.password.reset', [
                'token' => $token,
                'email' => $account->email])
            ], function($message) use ($account)
            {
                $message->to($account->email, $account->name);
                $message->subject(__('auth.reset_password.title'));
            }
        );

        Flash::success(__('passwords.sent'));
        return redirect()->back();
    }
}
