<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Admin;
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
        $this->middleware('guest:admin');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if(is_null($admin = Admin::where('email', $request->email)->first())) {
            Flash::error(__('passwords.user'));
            return redirect()->back();
        }

        $token = Str::random(64);

        DB::table('password_resets')->where(['email'=> $admin->email])->delete();

        DB::table('password_resets')->insert([
            'email' => $admin->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
            ]);

        Mail::send('emails.password', [
            'link' => route('admin.password.reset', [
                'token' => $token,
                'email' => $admin->email])
            ], function($message) use ($admin)
            {
                $message->to($admin->email, $admin->name);
                $message->subject(__('auth.reset_password.title'));
            }
        );

        Flash::success(__('passwords.sent'));
        return redirect()->back();
    }
}
