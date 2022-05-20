<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Flash;
use Hash;
use DB;
use Auth;

class ResetPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null              $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        if(!is_null($token)) {
            $updatePassword = DB::table('password_resets')->where([
                'email' => $request->email, 
                'token' => $token
            ])->first();

            if(!$updatePassword){
                return redirect()->route('admin.password.request')->withInput()->withErrors(['email', __('passwords.invalid')]);
            }
        }

        return view('admin.auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|string|min:8|max:255|confirmed'
        ]);

        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->email, 
            'token' => $request->token
        ])->first();

        if(!$updatePassword){
            return redirect()->route('admin.password.request')->withInput()->withErrors(['email', __('passwords.invalid')]);
        }

        $admin = Admin::where('email', $request->email)->first();
        $admin->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        Flash::success(__('passwords.success'));
        if($admin->active) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.home');
        }
        return redirect()->route('admin.login');
    }
}
