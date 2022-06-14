<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Flash;
use Auth;
use Mail;
use Hash;

class VerifyPhoneController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));
            return redirect()->route('login');
        }
        if(!is_null($user->phone_verified_at)) {
            return redirect()->route('login');
        }

        return view('auth.verify-phone')->with('user', $user);
    }

    public function send($id)
    {
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            $error = __('messages.not_found', ['model' => __('models/users.singular')]);
            return response()->json(['success' => false, 'message' => $error]);
        }

        $code = rand(1000, 9999);
        $user = $this->userRepository->update(['phone_verification_code' => Hash::make($code)], $id);

        // Send Phone Verification Code By SMS
        try {

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

        return redirect()->route('verification.verify', ['id' => $request->id]);
    }

    public function verify($id, Request $request)
    {
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            Flash::error(__('messages.not_found', ['model' => __('models/users.singular')]));
            return redirect()->route('login');
        }

        if(!Hash::check($request->code, $user->phone_verification_code)) {
            Flash::error(__('auth.verify_phone.error'));
            return redirect()->route('verification.verify', ['id' => $id]);
        }

        $user = $this->userRepository->update(['phone_verified_at' => Carbon::now()->format('Y-m-d H:i:s')], $id);

        Flash::success(__('auth.verify_phone.verify_success'));
        return redirect()->route('login');
    }
}
