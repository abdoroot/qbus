<?php

namespace App\Http\Controllers\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Provider;
use App\Models\Account;
use Illuminate\Http\Request;
use Auth;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:provider')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('provider');
    }

    public function showLoginForm(Request $request)
    {
        return view('provider.auth.login')->with('name', $request->name);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $account = Account::where([
            'username' => $request->username
        ])->first();

        if(is_null($account)) {
            return redirect()->back()->withInput()->withErrors([
                'name' => __('auth.failed')
            ]);
        }
        
        if(!$account->active) {
            return redirect()->back()->withInput()->withErrors([
                'email' => trans('auth.inactive')
            ]);
        }

        $provider = $account->provider;
        if(is_null($provider)) {
            return redirect()->back()->withInput()->withErrors([
                'name' => __('auth.failed')
            ]);
        }
        if(!$provider->approve) {
            return redirect()->back()->withInput()->withErrors([
                'email' => trans('auth.unapproved')
            ]);
        }
        if($provider->block) {
            return redirect()->back()->withInput()->withErrors([
                'email' => __('auth.blocked')
            ]);
        }

        if (Auth::guard('provider')->attempt($credentials, $request->get('remember'))) {
            return redirect()->intended(route('provider.home'));
        }
        
        return redirect()->back()->withInput()->withErrors([
            'email' => trans('auth.failed')
        ]);
    }
}
