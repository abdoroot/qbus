<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Setting;
use App\Models\Additional;
use Response;

/**
 * Class FeatureController
 * @package App\Http\Controllers\API
 */

class SettingsAPIController extends AppBaseController
{
    public function aboutUs()
    {
        $data =[
            "about_title" => Setting::where('key','about_title')->first(),
            "about_subtitle" => Setting::where('key','about_subtitle')->first(),
            "about_text" => Setting::where('key','about_text')->first(),
            "about_image" => asset("images/settings/".Setting::where('key','about_image')->first()['value']),
        ];
        return $data;
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
        return $data;
    }


    public function social()
    {
        $data =[
            "twitter" => Setting::where('key','twitter')->first()['value'],
            "facebook" => Setting::where('key','facebook')->first()['value'],
            "instagram" => Setting::where('key','instagram')->first()['value'],
            "youtube" => Setting::where('key','youtube')->first()['value'],
        ];

        return $data;
    }

    public function additionals()
    {
        $data = Additional::all();
        return $data;
    }

}

