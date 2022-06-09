<?php

namespace App\Http\Controllers\API;
use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\smsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Response;
use App\Models\Otp;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public $successStatus = 200;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }


    public function ReturnJson($message,$data,$code = 1){
        $array = [
            'message' => $message,
            'code' => $code,
        ];

        if($data != ""){
            $array['data'] = $data;
        }else{
            $array['data'] = [] ;
        }
        return $array;
    }


    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')]) || Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){
            $user = Auth::user();
            $token =  $user->createToken('Qbus')-> accessToken;
            //remove null values
            //$user= array_map('array_filter', $user);

            return response()->json( $this->ReturnJson("success",['token' => $token,
                "user" => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email ?? '',
                    'phone' => $user->phone ?? '',
                    'image' => $user->image ?? '',
                    'address' => $user->address ?? '',
                    'date_of_birth' => $user->date_of_birth ?? '',
                    'marital_status' => $user->marital_status ?? '',
                    'block' => $user->block ?? 0,
                    'block_notes' => $user->block_notes ?? '',
                    'wallet' => $user->wallet ?? '',
                    'language' => $user->language ?? 'ar',
                ],
            ]), $this->successStatus);
        }
        else{
            return response()->json( $this->ReturnJson("Unauthorised",["message" => "Unauthorised"],0),400);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'min:8', 'unique:users'],
            'city_id' => ['numeric','exists:cities,id'],
            'address' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'max:255'],
            'marital_status' => ['required',Rule::in(['married', 'single']), 'string', 'max:20'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors = json_decode(json_encode($errors),true);

            $newErrors = [];

            foreach ($errors as $key => $value){
                array_push($newErrors,[$key => $value[0]]);
            }


            return response()->json( $this->ReturnJson("Please ReCheck the ",[
                "validate_errors" => $newErrors
            ],0),401);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('Qbus')-> accessToken;
        $success['user'] =  [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email ?? '',
            'phone' => $user->phone ?? '',
            'image' => $user->image ?? '',
            'city_id' => $user->city_id ?? '',
            'address' => $user->address ?? '',
            'date_of_birth' => $user->date_of_birth ?? '',
            'marital_status' => $user->marital_status ?? '',
            'block' => $user->block ?? 0,
            'block_notes' => $user->block_notes ?? '',
            'wallet' => $user->wallet ?? '',
            'language' => $user->language ?? 'ar',
        ];
        $send = app('App\Http\Controllers\Auth\VerifyPhoneController')->send($user->id);
        $send = (array)$send ;
        return response()->json( $this->ReturnJson($send['original']['message'],$success,1),$this-> successStatus);
    }

    public function verifyPhone(Request $request){
        $user = Auth::user();
        if(Hash::check($request->code, $user->phone_verification_code)) {
            $user->update(['phone_verified_at' => Carbon::now()->format('Y-m-d H:i:s')]);
            return response()->json( $this->ReturnJson("Phone Verified Successfully",['message' => "Phone Verified Successfully"],1),200);
        }else{
            return response()->json( $this->ReturnJson("Error validation Code",['message' => "Error validation Code"],0),400);
        }
    }

    public function forgetPassword(Request $request){
        //$user = Auth::user();
        $validator = Validator::make($request->all(),[
            'phone' => ['required', 'numeric', 'min:8', 'exists:users,phone'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors = json_decode(json_encode($errors),true);

            $newErrors = [];

            foreach ($errors as $key => $value){
                array_push($newErrors,[$key => $value[0]]);
            }

            return response()->json( $this->ReturnJson("Please Re Check the data",[
                "validate_errors" => $newErrors
            ],0),401);
        }

        $input    = $request->all();
        $phone    = $input['phone'];
        $user = User::where('phone',$phone)->first();
        $code = rand(1000, 9999);
        $smsMessage  = "Qbus OTP ".$code;

        //delete old otps
        Otp::where("user_id",$user->id)->delete();;
        //store otp
        Otp::create(
            [
                "code" => $code,
                "user_id"=> $user->id
            ]
        );

        //send Otp password
        $sendSms = smsController::sendSms($phone,$smsMessage);
        if($sendSms){
            $responseMessage = "Reset Password Otp has been sent to +966".substr($phone,0,-4)."**** you can use ".$code;
            return response()->json( $this->ReturnJson($responseMessage,["message" => $responseMessage],1),200);
        }else{
            return response()->json( $this->ReturnJson("message not send",["message" => "message not send"],0),400);
        }

    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'marital_status' => ['required',Rule::in(['married', 'single']), 'string', 'max:20'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors = json_decode(json_encode($errors),true);
            $newErrors = [];
            foreach ($errors as $key => $value){
                array_push($newErrors,[$key => $value[0]]);
            }

            return response()->json( $this->ReturnJson("Please Re Check the data",[
                "validate_errors" => $newErrors
            ],0),401);
        }

        $input = $request->all();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->address = $input['address'];
        $user->marital_status = $input['marital_status'];

        if($user->save()){
            return response()->json( $this->ReturnJson("profile updated successfully",["message" => "profile updated successfully"],1),200);
        }else{
            return response()->json( $this->ReturnJson("some thing went wrong",["message" => "some thing went wrong"],0),400);
        }

    }

    public function resetPassword(Request $request){

        $validator = Validator::make($request->all(),[
            'code' => ['required', 'numeric', 'min:4','exists:users_otp,code'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors = json_decode(json_encode($errors),true);

            $newErrors = [];

            foreach ($errors as $key => $value){
                array_push($newErrors,[$key => $value[0]]);
            }

            return response()->json( $this->ReturnJson("Please Re Check the data",[
                "validate_errors" => $newErrors
            ],0),401);
        }

        $input    = $request->all();
        $password    = Hash::make($input['password']);
        $code     = $input['code'];
        $opt =  Otp::where('code',$code)->first();
        //reset the password now
        $op =  User::where('id',$opt->user_id)->update(['password' => $password]);

        if($op){
            $responseMessage = "Your Password Reset Successfully";
            return response()->json( $this->ReturnJson($responseMessage,["message" => $responseMessage],1),200);
        }else{
            return response()->json( $this->ReturnJson("Some thing went Wrong",["message" => "Some thing went Wrong"],0),400);
        }

    }

    public function resendVerificationCode(){
        $user = Auth::user();
        $send = app('App\Http\Controllers\Auth\VerifyPhoneController')->send($user->id);
        $send = (array)$send ;
        return response()->json( $this->ReturnJson($send['original']['message'],['message' => $send['original']['message']],1),200);
    }

    public function userInfo(){
        $user = Auth::user();
        return response()->json( $this->ReturnJson("success",[
            "user" => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email ?? '',
                'phone' => $user->phone ?? '',
                'image' => $user->image ?? '',
                'address' => $user->address ?? '',
                'date_of_birth' => $user->date_of_birth ?? '',
                'marital_status' => $user->marital_status ?? '',
                'block' => $user->block ?? 0,
                'block_notes' => $user->block_notes ?? '',
                'wallet' => $user->wallet ?? '',
                'language' => $user->language ?? 'ar',
            ]
        ],1),200);
    }

    public function logout(){
        $user = Auth::user()->token()->revoke();
        return response()->json( $this->ReturnJson('logout successfully',["message" => "logout successfully"],1),200);
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $users->toArray(),
            __('messages.retrieved', ['model' => __('models/users.plural')])
        );
    }

    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        return $this->sendResponse(
            $user->toArray(),
            __('messages.saved', ['model' => __('models/users.singular')])
        );
    }

    public function show($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/users.singular')])
            );
        }

        return $this->sendResponse(
            $user->toArray(),
            __('messages.retrieved', ['model' => __('models/users.singular')])
        );
    }

    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/users.singular')])
            );
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse(
            $user->toArray(),
            __('messages.updated', ['model' => __('models/users.singular')])
        );
    }

    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/users.singular')])
            );
        }

        $user->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/users.singular')])
        );
    }
}
