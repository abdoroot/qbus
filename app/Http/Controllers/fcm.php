<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;

class fcm extends Controller
{
    private $client;

    private $httpClient;

    private $jsonKey;

    private $service;

    function __construct(){


        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path() . '/qbus-app-25e71bbd57ba.json');

        $this->client = new Client();

        $this->client->useApplicationDefaultCredentials();

        $this->client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $this->httpClient = $this->client->authorize();

    }

    function sendFCM($topic,$title,$body,$data) {

        $request = [
            'message' =>[
                'topic'=> $topic,
                'notification' => [
                    'title' => $title,
                    'body' => $body
                ],
                'data' => $data
            ]
        ];

        $response =   $this->httpClient->post(
            "https://fcm.googleapis.com/v1/projects/qbus-app/messages:send",
            [
                'json' => $request
            ]);

        if($response->getStatusCode() == 200){
            return true;
        }else{
            return false;
        }
    }
}
