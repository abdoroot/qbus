<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;


class smsController extends Controller
{
    private $client;

    private $publicKey;

    function __construct(){

        $this->publicKey = "2P-DjY8I4wC5MZecaX1K2u2p65kX4648wDPfMg13ZJU";

        $this->client = new Client([
           'base_uri' => 'https://api.oursms.com/',
           //'timeout'  => 2.0,
        ]);;
    }

    public function sendSms($phone,$smsMessage)
    {
        try{
            $response = $this->client->post('/msgs/sms',[
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->publicKey ,
                    'Accept'        => 'application/json',
                    ],
                'json' => [
                    'src' => 'QBus',
                    'dests' => [$phone],
                    'body' => $smsMessage,
                    'priority' => 1,
                ]
            ]);

            return $response;
        }
        catch(Exception $e){
            echo $e;
      }


    }
}
