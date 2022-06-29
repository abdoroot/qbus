<?php

namespace App\Http\Controllers\Provider\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\smsController;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Flash;
use Auth;
use Mail;
use Hash;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | provider that recently registered with the application. Emails may also
    | be re-sent if the provider didn't receive the original email message.
    |
    */

    /** @var ProviderRepository $providerRepository*/
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show($id)
    {
        $provider = $this->providerRepository->find($id);
        if (empty($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect()->route('provider.login');
        }
        if(!is_null($provider->phone_verified_at)) {
            if(is_null($provider->accounts->first())) {
                return redirect()->route('provider.account', ['id' => $id]);
            }

            return redirect()->route('provider.login');
        }

        return view('provider.auth.verify')->with('provider', $provider);
    }

    public function send($id)
    {
        $sms = new smsController;
        $provider = $this->providerRepository->find($id);
        if (empty($provider)) {
            $error = __('messages.not_found', ['model' => __('models/providers.singular')]);
            return response()->json(['success' => false, 'message' => $error]);
        }

        $code = rand(1000, 9999);
        $provider = $this->providerRepository->update(['phone_verification_code' => Hash::make($code)], $id);

        // Send Phone Verification Code By SMS
        try {
            $sms->sendSms($provider->phone,__('auth.verify_phone.please_use_this_code') . ' '.$code);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => __('auth.verify_phone.error_sending')]);
        }

        return response()->json(['success' => true, 'message' => __('auth.verify_phone.success') . ' ' . 'Code : ' . $code]);
    }

    public function resend(Request $request)
    {
        $send = $this->send($request->id);
        $data = $send->getData();
        if(!$data->success) {
            Flash::error($data->message);
        } else {
            Flash::success($data->message);
        }

        return redirect()->route('provider.verification.verify', ['id' => $request->id]);
    }

    public function verify($id, Request $request)
    {
        $provider = $this->providerRepository->find($id);
        if (empty($provider)) {
            Flash::error(__('messages.not_found', ['model' => __('models/providers.singular')]));
            return redirect()->route('provider.login');
        }

        if(!Hash::check($request->code, $provider->phone_verification_code)) {
            Flash::error(__('auth.verify_phone.error'));
            return redirect()->route('provider.verification.verify', ['id' => $id]);
        }

        $provider = $this->providerRepository->update(['phone_verified_at' => Carbon::now()->format('Y-m-d H:i:s')], $id);

        Flash::success(__('auth.verify_phone.verify_success'));
        return redirect()->route('provider.account', $id);
    }
}
