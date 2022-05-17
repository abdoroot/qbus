<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        $rules = User::$rules;
        $rules['password'][] = 'confirmed';
        $this->validate($request, $rules);

        return $request->all();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'date_of_birth' => $data['date_of_birth'],
            'marital_status' => $data['marital_status'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        DB::beginTransaction();

        $data = $this->validator($request);

        $user = $this->create($request->all());

        // verify user phone 
        $send = app('App\Http\Controllers\Auth\VerifyPhoneController')->send($user->id);
        $data = $send->getData();
        if(!$data->success) {
            return redirect()->back()->withInput()->withErrors(['phone' => $data->message]);
        }
        
        DB::commit();
        
        return redirect()->route('verification.verify', ['id' => $user->id]);
    }
}
