<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Carbon\Carbon;
use Flash;
use Hash;
use DB;
use Auth;

class ResetPasswordPhoneController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest:web');
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
                'email' => $request->phone, 
                'token' => $token
            ])->first();

            if(!$updatePassword){
                return redirect()->route('password.phone')->withInput()->withErrors(['phone', __('passwords.invalid')]);
            }
        }

        return view('auth.passwords.reset_phone')->with(['phone' => $request->phone]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'phone' => 'required|phone|exists:users',
            'password' => 'required|string|min:8|max:255|confirmed'
        ]);

        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->phone, 
            'token' => $request->token
        ])->first();

        if(!$updatePassword){
            return redirect()->route('password.phone')->withInput()->withErrors(['phone', __('passwords.invalid')]);
        }

        $user = User::where('phone', $request->phone)->first();
        $user->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->phone])->delete();

        Flash::success(__('passwords.success'));
        if(!$user->block) {
            Auth::guard('web')->login($user);
            return redirect()->route('home');
        }
        return redirect()->route('login');
    }
}
