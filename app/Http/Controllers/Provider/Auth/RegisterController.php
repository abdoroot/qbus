<?php

namespace App\Http\Controllers\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Provider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\City;
use App;
use Flash;
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
    public $redirectTo;

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
     * Where to redirect users after registration.
     *
     * @return string
     */
    public function redirectTo()
    {
        return $this->redirectTo = route('provider.home');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        $rules = Provider::$rules;
        $rules['password'][] = 'confirmed';
        unset($rules['username']);
        unset($rules['password']);
        
        $validator = $this->validate($request, $rules);
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Provider
     */
    protected function create(Request $request)
    {
        $input = $request->only([
            'name',
            'email',
            'phone',
            'address',
            'comm_name',
            'comm_reg_num',
            'comm_reg_img',
            'tax_cert_num',
            'cities'
        ]);

        if ($request->hasFile('comm_reg_img')) {
            $file = $request->file('comm_reg_img');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/providers'), $filename);
                $input['comm_reg_img'] = $filename;
            }
        }
        
        $provider = Provider::create($input);

        return $provider;
    }

    public function showRegistrationForm()
    {
        $cities = City::pluck('name', 'id');
        return view('provider.auth.register')->with('cities', $cities);
    }

    public function register(Request $request)
    {
        DB::beginTransaction();

        $data = $this->validator($request);

        $provider = $this->create($request);

        // verify provider phone 
        $send = app('App\Http\Controllers\Provider\Auth\VerificationController')->send($provider->id);
        $data = $send->getData();
        if(!$data->success) {
            return redirect()->back()->withInput()->withErrors(['phone' => $data->message]);
        }
        
        DB::commit();
        
        return redirect()->route('provider.verification.verify', ['id' => $provider->id]);
    }

    public function showAccountForm($id)
    {
        $provider = Provider::find($id);
        if(is_null($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect()->route('');
        }
        if(!is_null($provider->accounts->first())) {
            return redirect()->route('provider.login');
        }

        return view('provider.auth.account')->with('provider_id', $id);
    }

    public function account($id, Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255|unique:accounts,username',
            'password' => 'required|string|min:8|max:255',
        ]);

        $provider = Provider::find($id);
        if(is_null($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect()->route('');
        }

        if(!is_null($provider->accounts->first())) {
            return redirect()->route('provider.login');
        }

        $provider->accounts()->create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'active' => true,
            'role' => 'admin'
        ]);

        Flash::success(__('messages.saved', ['model' => __('models/accounts.singular')]));
        return redirect()->route('provider.login', ['username' => $request->username]);;
    }
}
