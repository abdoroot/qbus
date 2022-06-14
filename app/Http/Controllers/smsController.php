<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class smsController extends Controller
{
    static function sendSms($phone,$smsMessage)
    {
        return true;
    }
}
