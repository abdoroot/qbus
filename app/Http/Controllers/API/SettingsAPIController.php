<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Setting;
use App\Models\Additional;
use App\Models\Package;
use App\Models\Trip;
use Response;
use App\Models\City;
use function PHPUnit\Framework\isNull;

/**
 * Class FeatureController
 * @package App\Http\Controllers\API
 */

class SettingsAPIController extends AppBaseController
{

    public function ReturnJson($message,$data,$code = 1){
        $array = [
            'message' => $message,
            'code' => $code,
        ];

        if($data != ""){
            $array['data'] = $data;
        }else{
            $array['data'] = ['message' => ""] ;
        }
        return $array;
    }

    public function cites()
    {
        $data = City::all();
        return response()->json( $this->ReturnJson("success",['cites' => $data],1),200);
    }

    public function showCity($id)
    {
        $data = City::where('id',$id);
        if($data->count() > 0){
            return response()->json( $this->ReturnJson("success",['cites' => $data->first()],1),200);
        }else{
            return response()->json( $this->ReturnJson("error",['message' => 'no data found'],0),400);
        }
    }

    public function aboutUs()
    {
        $data =[
            "about_title" => Setting::select("trans")->where('key','about_title')->first() ?? "",
            "about_subtitle" => Setting::select("trans")->where('key','about_subtitle')->first() ?? "",
            "about_text" => Setting::select("trans")->where('key','about_text')->first() ?? "",
            "about_image" => asset("images/settings/".Setting::where('key','about_image')->first()['value']),
        ];
        return response()->json( $this->ReturnJson("success",['about_us' => array_filter($data)],1),200);
    }

    public function contactUsDetails()
    {
        $data =[
            "location" => Setting::where('key','location')->first()['value'],
            "email" => Setting::where('key','email')->first()['value'],
            "phone" => Setting::where('key','phone')->first()['value'],
            "phone2" => Setting::where('key','phone2')->first()['value'],
            "email2" => Setting::where('key','email2')->first()['value'],
        ];

        return response()->json( $this->ReturnJson("success",['contact_us' => array_filter($data)],1),200);

    }

    public function social()
    {
        $data =[
            "twitter" => Setting::where('key','twitter')->first()['value'],
            "facebook" => Setting::where('key','facebook')->first()['value'],
            "instagram" => Setting::where('key','instagram')->first()['value'],
            "youtube" => Setting::where('key','youtube')->first()['value'],
        ];
        return response()->json( $this->ReturnJson("success",['social_link' => array_filter($data)],1),200);

    }

    public function additionals()
    {
        $data = Additional::all();
        return response()->json( $this->ReturnJson("success",['additional' => $data],1),200);
    }

    public function packageAdditionals($packageId)
    {
        $package = Package::where('id',$packageId)->first()->toArray();
        $packageAdditional = $package['additional'];
        if(count($packageAdditional) > 0){
            $additionals = [];
            foreach ($packageAdditional as $key => $value){
                $row = Additional::where('id',$value['id'])->first()->toArray();
                $row['fees'] = $value['fees'];
                array_push($additionals,$row);
            }
            return response()->json( $this->ReturnJson("success",['additional' => $additionals],1),200);
        }else{
            return response()->json( $this->ReturnJson("error",['message' => 'no data found'],0),400);
        }
    }

    public function tripAdditionals($tripId)
    {
        $trip = Trip::where('id',$tripId)->first()->toArray();
        $tripAdditional = $trip['additional'];
        if(count($tripAdditional) > 0){
            $additionals = [];
            foreach ($tripAdditional as $key => $value){
                $row = Additional::where('id',$value['id'])->first()->toArray();
                $row['fees'] = $value['fees'];
                array_push($additionals,$row);
            }
            return response()->json( $this->ReturnJson("success",['additional' => $additionals],1),200);
        }else{
            return response()->json( $this->ReturnJson("error",['message' => 'no data found'],0),400);
        }
    }

    public function showAdditionals($id)
    {
        $data = Additional::where('id',$id);
        if($data->count() > 0){
            return response()->json( $this->ReturnJson("success",['additional' => $data->first()],1),200);
        }else{
            return response()->json( $this->ReturnJson("error",['message' => 'no data found'],0),400);
        }
    }

    public function privacyPolicy()
    {
        $data = Setting::where('key','privacy_policy')->first()->toArray();
        //dd(Setting::where('key','privacy_policy')->first()->toArray());
        return response()->json( $this->ReturnJson("success",['privacy_policy' => $data['trans']],1),200);
    }

    public function returnPolicy()
    {
        $data = Setting::where('key','return_policy')->first()->toArray();
        return response()->json( $this->ReturnJson("success",['return_policy' => $data['trans']],1),200);
    }
}

