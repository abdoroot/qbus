<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Flash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        $user = User::where('phone', $request->phone)->first();
        if(!is_null($user)) {
            if(!$user->phone_verified_at) {
                Flash::error(__('msg.verify_your_phone_number_before_login'));
                return redirect()->route('verification.verify', ['id' => $user->id]);
            }
            if($user->block) {
                return redirect()->back()->withInput()->withErrors([
                    'phone' => __('auth.blocked')
                ]);
            }
        }

        if (Auth::attempt($credentials, $request->get('remember'))) {
            return redirect()->intended(route('profile.index'));
        }
        
        return redirect()->back()->withInput()->withErrors([
            'phone' => trans('auth.failed')
        ]);
    }
}
