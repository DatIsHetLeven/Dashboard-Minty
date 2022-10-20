<?php

namespace App\Http\Controllers\Connection\MintyBol_API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ModuleController;
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
    //Controleren of modules al aangezet zijn (bij het laden van de pagina)
    public function CheckModuleBolUser($bolUserId, $identifier){
        $moduleBschikbaar = false;

        try {
            $this->guzzleClient->request('Get', 'modules/User/'.$bolUserId.'?identifier='.$identifier, ['headers' => $this->headers]);
            $moduleBschikbaar = true;
            return $moduleBschikbaar;
        } catch (GuzzleException $e){

            return $moduleBschikbaar;
        }
        return $moduleBschikbaar;
    }

    //Create standaard module per boluser
    public function CreateModuleBolUser($bolUserId, $identifier){
        $ModuleController = new ModuleController();

        //Controleren of gebruiker al modules heeft.
        $moduleUserList = 0;
        //Als gebruiker de module al heeft.
        try {
            $response = $this->guzzleClient->request('Get', 'modules/User/'.$bolUserId.'?identifier='.$identifier, ['headers' => $this->headers]);
            dd($response);
        } catch (GuzzleException $e) {

            dump('ERRORRRRRRR');

            $body = json_encode([
                "bolUserId" => $bolUserId,
                "identifier" => $identifier,
                "settings" => "{}",
            ]);

            $this->headers['Content-Type'] = 'application/json';
            $response = $this->guzzleClient->request('POST', 'modules/User', ['headers' => $this->headers, 'body' => $body]);
            dd($response->getBody());
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
















    //Create mandate
    public function CreateMandate(){
        $userIdAPI = 567;
        try {
            $response = $this->guzzleClient->request('GET', 'mandate/'.$userIdAPI, ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
        }
    }

    //Check mandate status
    public function CheckMandateStatus(){
        $customerId = 4567;
        try {
            $response = $this->guzzleClient->request('GET', 'mandate/'.$customerId.'/status', ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
        }

        //If paid -> insert user in FS -> NIET VERGETEN -> BANKCODE + BICCODE MEEGEVEN
    }




}
