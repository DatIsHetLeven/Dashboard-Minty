<?php

namespace App\Http\Controllers\Connection\MintyBol_API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


//Prachtige API van Arthur :o
class MintyBolController extends Controller
{
    private string $baseUrl;
    private $headers;
    private $guzzleClient;
    private $mollieId;

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

    //Create a new bol account
    public  function  CreateWooAccount($userId, $host, $key, $secret){
        try {
            $body = json_encode([
                "userId" => $userId,
                "host" => $host,
                "wooKey" => $key,
                "secret" => $secret,
            ]);

            $this->headers['Content-Type'] = 'application/json';

            $response = $this->guzzleClient->request('POST', 'accounts/woo', ['headers' => $this->headers, 'body' => $body]);
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
    }

    //Create standaard module per boluser
    public function CreateModuleBolUser($bolUserId, $identifier){
        try {
            $response = $this->guzzleClient->request('Get', 'modules/User/'.$bolUserId.'?identifier='.$identifier, ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            $body = json_encode([
                "bolUserId" => $bolUserId,
                "identifier" => $identifier,
                "settings" => "{}",
            ]);

            $this->headers['Content-Type'] = 'application/json';
            $response = $this->guzzleClient->request('POST', 'modules/User', ['headers' => $this->headers, 'body' => $body]);
        }
    }

    public function deleteModuleBolUser($bolUserId, $identifier){
        try {
            $response = $this->guzzleClient->request('DELETE', 'modules/User/'.$bolUserId.'?identifier='.$identifier, ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            dd("error delete module user");
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
    public function getSingleModuleUser(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId)->userIdApi;

        $response = $this->guzzleClient->request('GET', 'modules/user/'.$bolUser, ['headers' => $this->headers]);
        return json_decode($response->getBody()->getContents());
    }



    //Get single module
    public function GetSingleModule($moduleId){
        $response = $this->guzzleClient->request('GET', 'modules?identifier='.$moduleId, ['headers' => $this->headers]);

        return json_decode($response->getBody()->getContents());
    }

    //Get all logs
    public function GetLogs(){
        //Check wat de hoogste pagina is - Laatste updates
        $response = $this->guzzleClient->request('GET', 'logs?page=31', ['headers' => $this->headers]);
        $maxPage = json_decode($response->getBody()->getContents());
        //Haal meest recente logs op.
        $logList = $this->guzzleClient->request('GET', 'logs?page='.$maxPage->pages, ['headers' => $this->headers]);
        return json_decode($logList->getBody()->getContents());
    }

    //Update Order Wachtagent Plugin
    public function updateOrderWachtagent(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        $phone = "";
        $email = "";

        if (isset($_POST['phoneSetting']))$phone = "123456789";
        if (isset($_POST['emailSetting']))$email = "Mintymail@Media.nl";

        $body = json_encode([
            "bolUserId"=> $bolUser->userIdApi,
            "identifier"=> "bol.mintyconnect.order.wachtagent",
            "settings"=> [
                "phone"=> $phone,
                "email"=> $email,
                "status"=> "default"
        ]
        ]);
        $this->headers['Content-Type'] = 'application/json';
        $response = $this->guzzleClient->request('PUT', 'modules/user', ['headers' => $this->headers, 'body' => $body]);
        return redirect( 'GetAllModules');
    }

    //Update Product Wachtagent Plugin
    public function updateProductWachtagent(){

        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        $stock = "";
        $price = "";

        if (isset($_POST['stockSetting']))$stock = "true";
        if (isset($_POST['priceSetting']))$price = "true";

        $body = json_encode([
            "bolUserId"=> $bolUser->userIdApi,
            "identifier"=> "bol.mintyconnect.product.wachtagent",
            "settings"=> [
                "stockSync"=> $stock,
                "priceSync"=> $price,
            ]
        ]);
        //dd($body);
        $this->headers['Content-Type'] = 'application/json';
        $response = $this->guzzleClient->request('PUT', 'modules/user', ['headers' => $this->headers, 'body' => $body]);
        return redirect( 'GetAllModules');
    }

















    //Mandaat aanmaken
    public function CreateMandate(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);
        try {
            $response = $this->guzzleClient->request('GET', 'mandate/'.$bolUser->userIdApi, ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            dd("EROORRRR CREATE MANDATE!!!");
        }

        $responseBody = array(json_decode(($response->getBody()->getContents())));
        $this->mollieId = $responseBody[0]->customerId;

        return redirect(($responseBody[0]->checkoutUrl));
    }

    //Check mandate status
    public function CheckMandateStatus($customerIdMollie){

        try {
            $response = $this->guzzleClient->request('GET', 'mandate/'.$customerIdMollie.'/status', ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            dd("EROORR CHECK MANDATE STATUS!!!!");
        }

        $mandateStatus = array(json_decode($response->getBody()->getContents()));
        //Doorverwijzen juiste pagina na betaling
        if($mandateStatus[0]->status === 'paid'){
            $usercontroller = new UserController();
            $usercontroller->createUserFS($mandateStatus[0]->bankcode, $mandateStatus[0]->biccode, $mandateStatus[0]->customerId );
            return redirect('payment');
        }

        else return redirect('dashboard')->with(['error'=> "Er ging iets mis tijdens de betaling, probeer opnieuw!"]);
    }

    public function CheckIfBolUserExist(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        //Admins kunnen altijd de modules bekijken.
        if($loggedUser->rol === 1)return true;

        $response = $this->guzzleClient->request('GET', 'accounts/user/'.$bolUser->userIdApi.'/bol', ['headers' => $this->headers]);
        $checker = json_decode($response->getBody()->getContents());
        //dd($checker);
        if (empty($checker))return false;
        return true;
    }




}
