<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProviderRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\ProviderRepository;
use App\Repositories\AccountRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Provider;
use App\Models\Account;
use App\Models\City;
use Validator;
use Flash;
use Auth;
use Hash;
use App;
use DB;

class ProfileController extends AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /** @var  ProviderRepository */
    private $providerRepository;
    private $accountRepository;

    public function __construct(ProviderRepository $providerRepo, AccountRepository $accountRepo)
    {
        $this->providerRepository = $providerRepo;
        $this->accountRepository = $accountRepo;
    }

    public function index(Request $request)
    {
        $account = Auth::guard('provider')->user();

        $cities = City::pluck('name', 'id');
        $providerCities = (!is_null($provider = $account->provider) ? $provider->cities : []);
        
        return view('provider.profile.index')
            ->with('provider', $account->provider)
            ->with('account', $account)
            ->with('cities', $cities)
            ->with('providerCities', $providerCities)
            ->with('active', $request->active);
    }

    public function update(UpdateProviderRequest $request)
    {
        $account = Auth::guard('provider')->user();

        $input = $request->only(['name', 'email', 'phone', 'address']);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/providers'), $filename);
                $input['image'] = $filename;
            }
        }

        $provider = $this->providerRepository->update($input, $account->provider_id);

        Flash::success(trans('msg.updated_successfully', ['name' => trans('msg.profile')]));
        return redirect(route('provider.profile.index', ['active' => 'settings']));
    }

    public function account(UpdateAccountRequest $request)
    {
        $account = Auth::guard('provider')->user();

        $input = $request->only(['username', 'email', 'phone']);

        $account = $this->accountRepository->update($input, $account->id);

        Flash::success(trans('msg.updated_successfully', ['name' => trans('msg.profile')]));
        return redirect(route('provider.profile.index', ['active' => 'account']));
    }

    public function password(Request $request)
    {
        $account = Auth::guard('provider')->user();

        $rules = [
            'current_password' => 'required',
            'password' => 'required|min:8|max:255|confirmed'
        ];

        if(!Hash::check($request->current_password, $account->password)) {
            $error = trans('passwords.dismatch');
            return redirect()->back()->withInput()->withErrors(['current_password' => $error]);
        }

        $input = ['password' => Hash::make($request->password)];

        $request->validate($rules);

        $account = $this->accountRepository->update($input, $account->id);

        Flash::success(trans('msg.updated_successfully', ['name' => trans('msg.password')]));
        return redirect(route('provider.profile.index', ['active' => 'password']));
    }

    public function cities(Request $request)
    {
        $provider = Auth::guard('provider')->user()->provider;
        $cities = $request->cities ?? [];

        $provider->update(['cities' => $cities]);

        Flash::success(__('messages.updated', ['model' => __('models/cities.singular')]));
        return redirect(route('provider.profile.index', ['active' => 'cities']));
    }
}
