<?php

namespace App\Http\Controllers\Connection\MintyBol_API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


//De prachtige API van Arthur :o
class MintyBolController extends Controller
{
    private string $baseUrl;
    private $headers;
    private $guzzleClient;

    public function  __construct(){

        $token = '8b6694313db35e41fc5381ee4b0786fd7a39d96bcc959936dd20dc5dd451d99e';
        $this->headers = [
            'Authorization' => 'Basic ' . $token,
            'Accept' => 'application/json',
        ];
        $this->baseUrl = 'https://dev.bol.mintycloud.nl/api/v1/';

        $this->guzzleClient = new Client(['base_uri' => $this->baseUrl, 'verify' => false]);
        // $res = $client->request('GET', 'accounts/user/15', ['headers' => $headers]);
        // dd($res->getBody()->getContents());

    }
    //Create user
    public  function  CreateUserBolApi($email){

        $body = json_encode([
            "email" => $email,
            "verified" => 1
        ]);

        $this->headers['Content-Type'] = 'application/json';

        $response = $this->guzzleClient->request('POST', 'accounts/user', ['headers' => $this->headers, 'body' => $body]);

        $data = json_decode($response->getBody()->getContents());
        //dd($data->userId);
        return $data->userId;
    }

    //Get all modules
    public function GetAllModules(){

        // $res = $client->request('GET', 'accounts/user/15', ['headers' => $headers]);
        // dd($res->getBody()->getContents());
        try {
            $response = $this->guzzleClient->request('GET', 'modules', ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
        }

        $data = json_decode($response->getBody()->getContents());


        return $data;

    }




}
