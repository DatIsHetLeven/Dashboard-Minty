<?php

namespace App\Http\Controllers\Connection\MintyBol_API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


//Prachtige API van Arthur :o
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
    }
    //Create user
    public  function  CreateUserBolApi($email, $naam){
        $body = json_encode([
            "email" => $email,
            "verified" => 1,
            "name" => $naam
        ]);

        $this->headers['Content-Type'] = 'application/json';
        $response = $this->guzzleClient->request('POST', 'accounts/user', ['headers' => $this->headers, 'body' => $body]);
        $data = json_decode($response->getBody()->getContents());
        //dd($data->userId);
        return $data->userId;
    }

    //Create a new bol account
    public  function  CreateBolAccount($userId, $clientId, $secret, $country, $label){

        try {
            $body = json_encode([
                "userId" => $userId,
                "clientId" => $clientId,
                "secret" => $secret,
                "country" => $country,
                "label" => $label,
            ]);

            $this->headers['Content-Type'] = 'application/json';

            $response = $this->guzzleClient->request('POST', 'accounts/bol', ['headers' => $this->headers, 'body' => $body]);
        } catch (GuzzleException $e) {
            dd("gegevens onjuist, probeer opnieuw!");
        }
    }

    //Get all modules
    public function GetAllModules(){
        try {
            $response = $this->guzzleClient->request('GET', 'modules', ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
        }

        return json_decode($response->getBody()->getContents());
    }
    //Get single module
    public function GetSingleModule($moduleId){
        $correctLink = str_replace(' ', '.', $moduleId);

        $response = $this->guzzleClient->request('GET', 'modules?identifier='.$moduleId, ['headers' => $this->headers]);

        return json_decode($response->getBody()->getContents());
    }

    //Get all logs
    public function GetLogs(){
        try {
            $response = $this->guzzleClient->request('GET', 'logs?page=31', ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
        }
        return json_decode($response->getBody()->getContents());
    }




}
