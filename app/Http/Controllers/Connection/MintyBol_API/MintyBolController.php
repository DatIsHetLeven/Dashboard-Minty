<?php

namespace App\Http\Controllers\Connection\MintyBol_API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\statusdetails;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;



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
        $this->baseUrl = 'https://dev.api.bol.mintyconnect.nl/api/v1/';

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
        try {
            $response = $this->guzzleClient->request('POST', 'accounts/user', ['headers' => $this->headers, 'body' => $body]);

        }catch (RequestException $e){
            dd($e);
        }
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
            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return back()->with(['error'=> "Gegevens onjuist, probeer het opnieuw!"]);
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
            return back();
        } catch (GuzzleException $e) {

            if (str_contains($e->getMessage(), 'Is the consumer already'))return back()->with(['errorWoo'=> "U heeft al een verbinding met een webshop. Mocht u nog een webshop willen verbinden neem dan contact op met de klantenservice ."]);
            return back()->with(['errorWoo'=> "Kon niet verbinden. Gegevens niet juist"]);
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
    public function orderwachtagent($bolUserId, $identifier){

        try {
            $response = $this->guzzleClient->request('Get', 'modules/user/'.$bolUserId.'?identifier='.$identifier, ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            $body = json_encode([
                "userId" => $bolUserId,
                "identifier" => $identifier,
                "settings" => [
                    "phone" => "",
                    "email" => "",
                    "status" => "",
                ]
            ]);

            $this->headers['Content-Type'] = 'application/json';
            $response = $this->guzzleClient->request('POST', 'modules/user', ['headers' => $this->headers, 'body' => $body]);
        }
    }

    //Create standaard module per boluser
    public function productwachtagent($bolUserId, $identifier){
        try {
            $response = $this->guzzleClient->request('Get', 'modules/User/'.$bolUserId.'?identifier='.$identifier, ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            $body = json_encode([
                "userId" => $bolUserId,
                "identifier" => $identifier,
                "settings" => [
                    "syncStock" => "false",
                    "priceSync" => "false",
                    "bolToWooSync" => "false",
                    "wooToBolSync" => "false",
                    "managedByRetailer" => "false",
                ]
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
            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            return redirect('underConstruction');
        }
    }
    //Get single module
    public function getSingleModuleUser(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId)->userIdApi;
        try {
            $response = $this->guzzleClient->request('GET', 'modules/user/'.$bolUser, ['headers' => $this->headers]);
        }catch (RequestException $e){
            return redirect('underConstruction');
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
        //Haal de API key van de gebruiker op -> in de header.
        $apiKey = $this->getApiKey();
        $this->headers = [
            'Authorization' => 'Basic ' . $apiKey,
        ];


        //Check wat de hoogste pagina is - Laatste updates
        try {
            $response = $this->guzzleClient->request('GET', 'logs?page=1', ['headers' => $this->headers]);
            $maxPage = json_decode($response->getBody()->getContents())->pages;
            $logList = $this->guzzleClient->request('GET', 'logs?page='.$maxPage, ['headers' => $this->headers]);
        }catch (RequestException $e){
            return false;
        }


        //Haal meest recente logs op.
        //dd(json_decode($logList->getBody()->getContents()));
        return json_decode($logList->getBody()->getContents());
    }

    //Update Order Wachtagent Plugin
    public function updateOrderWachtagent(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        $phone = "";
        $email = "";
        $status = "";

        if (isset($_POST['phoneSetting']))$phone = "0612345678";
        if (isset($_POST['emailSetting']))$email = "bol@mintyconnect.nl";
        if (isset($_POST['statusSetting']))$status = "Default";


        $body = json_encode([
            "userId"=> $bolUser->userIdApi,
            "identifier"=> "bol.mintyconnect.order.wachtagent",
            "settings"=> [
                "phone"=> $phone,
                "email"=> $email,
                "status"=> $status,
        ]
        ]);
        $this->headers['Content-Type'] = 'application/json';
        $response = $this->guzzleClient->request('PUT', 'modules/user', ['headers' => $this->headers, 'body' => $body]);
        return redirect()->route( 'GetAllModules');
    }

    //Update Product Wachtagent Plugin
    public function updateProductWachtagent(){

        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        $stock = false;
        $price = false;
        $bolToWooSync = false;
        $wooToBolSync = false;
        $managedByRetailer = false;

        if (isset($_POST['stockSetting']))$stock = true;
        if (isset($_POST['priceSetting']))$price = true;
        if (isset($_POST['bolToWooSync']))$bolToWooSync = true;
        if (isset($_POST['wooToBolSync']))$wooToBolSync = true;
        if (isset($_POST['managedByRetailer']))$managedByRetailer = true;



        $bodyy = json_encode([
            "userId"=> $bolUser->userIdApi,
            "identifier"=> "bol.mintyconnect.product.management",
            "settings"=> [
                "syncStock" => $stock,
                "priceSync" => $price,
                "bolToWooSync" => $bolToWooSync,
                "wooToBolSync" => $wooToBolSync,
                "managedByRetailer" => $managedByRetailer,
            ]
        ]);
        //dd($body);
        $this->headers['Content-Type'] = 'application/json';
        $response = $this->guzzleClient->request('PUT', 'modules/user', ['headers' => $this->headers, 'body' => $bodyy]);
        return redirect()->route( 'GetAllModules');
    }


    //Mandaat aanmaken
    public function CreateMandate(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);
        try {
            $response = $this->guzzleClient->request('GET', 'mandate/'.$bolUser->userIdApi, ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            return back();
            dd("EROORRRR CREATE MANDATE!!!");
        }

        $responseBody = array(json_decode(($response->getBody()->getContents())));
        $this->mollieId = $responseBody[0]->customerId;
        //dd($responseBody[0]);
        return redirect(($responseBody[0]->checkoutUrl));
    }
    //Factuur aanmaken
    public function createFactuurFS($id){
//        $body = json_encode([
//            "clientnr" => $id,
//            "lines" => array(
//                array(
//                    "amount" => 1,
//                    "description" => "Minty Media's Bol-wooCommerce Koppeling",
//                    "tax_rate" => 21,
//                    "price" => 29.99,
//                )
//            ),
//            "action" => "repeat",
//            "savename" => "test",
//            "initialdate" => date("Y-m-d"),
//            "frequency" => "monthly",
//            "repeattype" => "auto",
//        ]);

        $body = json_encode([
            "clientnr"=> $id,
            "lines"=> array(
                array(
                    "amount"=> 1,
                    "description"=> "Minty Media's Bol-wooCommerce koppeling",
                    "tax_rate"=> 21,
                    "price"=> 29,99,
                )
            ),
        "action"=> "repeat",
        "savename"=> "test",
        "initialdate"=> date("Y-m-d"),
        "frequency"=> "monthly",
        "repeattype"=> "auto",
        "sendmethod"=> "email"
        ]);

        $this->headers['Content-Type'] = 'application/json';
        $response = $this->guzzleClient->request('POST', 'v1/invoices', ['headers' => $this->headers, 'body' => $body]);
        $data = json_decode($response->getBody()->getContents());
        dd($data);
    }

    //Check mandate status
    public function CheckMandateStatus($customerIdMollie){

        try {
            $response = $this->guzzleClient->request('GET', 'mandate/'.$customerIdMollie.'/status', ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            return back()->with(['error' => "Error check mandate status"]);
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
    public function checkBlokKlant(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();

        if(empty($loggedUser->userId))return false;
        $bool = $homeController->checkBlokKlant($loggedUser->userId);
        if ($bool == false) return false;

        return true;
    }
    public function CheckIfBolUserExist(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();

        if (empty($loggedUser->userId))return false;
        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        //Admins en betalende klanten kunnen altijd de modules bekijken.
        $vandaag =  date("Y-m-d") ;

        //dd($loggedUser);
        if ($loggedUser->rol ===2){
            //Laatste dag actief -> +30 dagen
            if ($vandaag == $loggedUser->geldig){
                $loggedUser = $homeController->updateStatus();
            }
        }

        if($loggedUser->rol === 1)return true;
        try {
            $response = $this->guzzleClient->request('GET', 'accounts/user/'.$bolUser->userIdApi.'/bol', ['headers' => $this->headers]);
        }catch (RequestException $e){
            return redirect('underConstruction');
        }
        $checker = json_decode($response->getBody()->getContents());
        if (empty($checker))return false;
        return true;
    }

    public function CheckIfWooUserExist(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        if (empty($loggedUser->userId))return false;

        $bolUser = $homeController->getUserBolId($loggedUser->userId);
        //Admins kunnen altijd de modules bekijken.
        if($loggedUser->rol === 1)return true;
        //dd($bolUser->userIdApi);
        try {
            $response = $this->guzzleClient->request('GET', 'accounts/woo/'.$bolUser->userIdApi, ['headers' => $this->headers]);
            $checker = json_decode($response->getBody()->getContents());

            if (empty($checker))return false;
            return true;
        }catch (GuzzleException $e){
            return false;
        }

    }

    public function blokkeerApi($userId){
        $homeController = new HomeController();
        $bolUser = $homeController->getUserBolId($userId)->userIdApi;


        $body = json_encode([
            "licenseIsActive"=> false
        ]);
        try {
            $this->headers['Content-Type'] = 'application/json';
            $response = $this->guzzleClient->request('PUT', 'accounts/user/'.$bolUser, ['headers' => $this->headers, 'body' => $body]);
        }catch (GuzzleException $e){
            return back()->with(['error'=> "HO-HO even rustig. De gebruiker is al geblokkeerd :( "]);
        }

        return back();
    }

    public function UpdateApiActief($id){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $statusDetails = statusdetails::where('userId', '=', $loggedUser->userId)->first();
        $statusDetails->API =$id;
        $statusDetails->save();
    }

    public function getAllBolConnection(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        try {
            $response = $this->guzzleClient->request('GET', 'accounts/user/'.$bolUser->userIdApi.'/bol', ['headers' => $this->headers]);

            return json_decode($response->getBody()->getContents());
        }catch (RequestException $e){

            return redirect('underConstruction');
        }

    }

    public function getWooConnection(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        try {
            $response = $this->guzzleClient->request('GET', 'accounts/woo/'.$bolUser->userIdApi, ['headers' => $this->headers]);
        }catch (GuzzleException $e){
            return false;
        }


        return json_decode($response->getBody()->getContents());
    }
    public  function getApiKey(){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);

        try {
            $response = $this->guzzleClient->request('GET', 'accounts/user/'.$bolUser->userIdApi, ['headers' => $this->headers]);
        }catch (RequestException $e){
            return false;
        }
        $datum = (date('Y-m-d H:i:s'));
        $datumIso = (date(DATE_ISO8601, strtotime($datum)));



        return (json_decode($response->getBody()->getContents())->apiKey->apiKey);
    }

    public function deleteBolUser($id){
        try {
            $response = $this->guzzleClient->request('DELETE', 'accounts/bol/'.$id, ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            return back()->with(['error'=> "Bol verbinding kon niet verwijderd worden. Probeer het later opnieuw"]);

        }
    }
    public function deleteWooConnection($id){
        try {
            $response = $this->guzzleClient->request('DELETE', 'accounts/woo/'.$id, ['headers' => $this->headers]);
        } catch (GuzzleException $e) {
            return back()->with(['error'=> "Woocommerce account kon niet verwijderd worden. Probeer het later opnieuw"]);
        }
    }

    public function updateExpireDate($newDate){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $bolUser = $homeController->getUserBolId($loggedUser->userId);
        //dd($newDate);

        $body = json_encode([
            "licenseExpiryDate"=> $newDate,
        ]);
        $this->headers['Content-Type'] = 'application/json';
        $response = $this->guzzleClient->request('PUT', 'accounts/user/'.$bolUser->userIdApi, ['headers' => $this->headers, 'body' => $body]);
    }

    public function getProducts($userApiKey){
        //UTH key veranderen
        $headers = [
            'Authorization' => 'Basic '.$userApiKey,
            'Accept' => 'application/json'
        ];

        try {
            $response = $this->guzzleClient->request('GET', 'bol/products/', ['headers' => $headers]);
            $products = json_decode($response->getBody()->getContents());
            return $products;
        }catch (GuzzleException $e){
            return false;
        }


    }

    public function checkEan($EanInput){

        //Veranderen naar AUTH KEY van de user.
        $headers = [
            'Authorization' => 'Basic 50bcb47fe4c33aba0acc606b3b8cfccc94a553c8b82e7c80a91880e4e1ceae29',
            'Accept' => 'application/json'
        ];




        try {
            $response = $this->guzzleClient->request('GET', 'bol/products/ean/'.$EanInput, ['headers' => $headers]);
        }catch (RequestException $e){
            return "Geen producten gevonden!";
        }

//        dd($response->getStatusCode());
//        if( $response->getStatusCode()  > 299) {
//            dd("ddd");
//        }


        $products = json_decode($response->getBody()->getContents());
        if (isset($products[0]->status))
        {
            return "Geen producten gevonden!";
        }
        return $products;
    }
}
