<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
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
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = Admin::where('email', $request->email)->first();
        if(!is_null($user)) {
            if(!$user->active) {
                return redirect()->back()->withInput()->withErrors([
                    'email' => trans('auth.inactive')
                ]);
            }
        }

        if (Auth::guard('admin')->attempt($credentials, $request->get('remember'))) {
            return redirect()->intended(route('admin.home'));
        }
        
        return redirect()->back()->withInput()->withErrors([
            'email' => trans('auth.failed')
        ]);
    }
    
    // public function logout()
    // {
    //     Session::flush();
        
    //     Auth::guard('admin')->logout();

    //     return redirect('home');
    // }
}
