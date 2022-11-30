<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Connection\Fs_Api\fsnl_api_Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\statusdetails;
use App\Models\factuursturen;
use App\Models\bolApi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;
use ReCaptcha\RequestMethod\Post;
use function Composer\Autoload\includeFile;


class UserController extends Controller
{

    //Haal inlog gebruiker op
    public function getUser()
    {

        if(!isset($_POST['loginButton'])) return redirect()->route('login')->with(['error'=> "login error"]);
        $username = $_POST['userName'];
        $CheckUserLogin = User::Where('email', '=', $username)->first();

        if(empty($CheckUserLogin)) return back()->with(['error'=> "Geberuiker niet gevonden"]);

        $password = password_verify($_POST['password'], $CheckUserLogin->password);
        if($password === TRUE)
        {
            $homeController = new HomeController();
            if (isset($_COOKIE['adminSessie']))setcookie("adminSessie", "", time() - (86400 * 30));

            // if table filles -> voer code in else doorgaan
            //CMaak cookie token + opslaan in db
            $cookieToken = $this->createToken();
            $CheckUserLogin->cookie_token = $cookieToken;
            $CheckUserLogin->save();

            setcookie('user', $cookieToken, time() + (86400 * 30));
            setcookie('userName', $CheckUserLogin->naam, time() +(86400 * 30));

            if (!empty($CheckUserLogin->Auth))return redirect('loggert');
            return redirect()->route('dashboard');
        }
        else return back()->with(['error'=> "Wachtwoord klopt niet!"]);
    }

    public function createPassword(Request $request)
    {
        if(isset($_POST['passwordButton']))
        {
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $resetToken = $_POST['resetToken'];
            //Check of gebruiker nog een token heeft -> wachtwoord wijzigen
            $getUser = User::where('token',  $resetToken)->first();
            if(empty($getUser)) return back()->with(['error'=> "Link niet meer geldig, vraag een nieuw wachtwoord aan"]);

            if($password == $password2)
            {
                $hashPassword = password_hash($password2, PASSWORD_DEFAULT);
                $getUser->password=$hashPassword;
                $getUser->token = NULL;
                $getUser->save();
                return redirect('login')->with(['succes'=> "Wachtwoord succesvol veranderd"]);
            }else return back()->with(['error'=> "Wachtwoord komt niet overeen"]);
        }
    }

    //Create user
    public function createUser()
    {
        // Maak gebruik van Illuminate\Http\Request implaats van de $_POST varaible - minty pawel
        if(isset($_POST['buttonregister']))
        {
            $newUser = new User();
            $newUser->email = $_POST['email'];

            $getUser = User::where('email', '=', $newUser->email)->first();

            if(!empty($getUser))return back()->with(['error'=> "Email al in gebruik"]);

            if(!empty($_POST['userRole'])){
                $userRole = $_POST['userRole'];
                if($userRole ==='Proefaccount')$newUser->rol = 3;
                if($userRole ==='Gebruiker')$newUser->rol = 2;
                if($userRole ==='Admin')$newUser->rol = 1;
            }else{$newUser->rol = 3;}


            $newUser->naam = $_POST['userName'];
            $newUser->password = $this->createToken();
            $newUser->telefoonnummer = $_POST['Telefoonnummer'];
            $newUser->bedrijfsnaam = $_POST['Bedijfsnaam'];
            $newUser->btwNummer = $_POST['BTW-Nummer'];
            $newUser->adres = $_POST['Adres'];
            $newUser->postcode = $_POST['Postcode'];
//            dubbele code  - minty pawel
            $newUser->plaats = $_POST['Plaats'];
            $newUser->plaats = $_POST['Plaats'];
            $newUser->land = ($_POST["land"]);
            $newUser->Auth = "";


            $passwordToken = $this->createToken();
            $newUser->token=$passwordToken;
            $mailSender = new MailController();
            $mailSender->sendPassword($passwordToken, $newUser->email, $newUser->naam);

            $newUser->save();

            $newStatus = new statusdetails();
            $newStatus->userId = $newUser->userId;
            $newStatus->geverifieerd = 0;
            $newStatus->geabonneerd = 0;
            $newStatus->API = 0;
            $newStatus->wordpress = 0;
            $newStatus->server = "n.v.t.";

            $geldig14dagen = date('Y-m-d', strtotime(' +14 day'));
            $newStatus->geldig = $geldig14dagen;
            $newStatus->save();

            //Gebruiker aanmaken voor de BOL-koppeling
            //UserId ophalen eigen db nieuwe User
            $userId = User::where('email', '=', $newUser->email)->first();
            //UserId aanmaken bol-koppeling van Arthur
            $MintyBolApi = new MintyBolController();
            $userIdBol = $MintyBolApi->CreateUserBolApi($newUser->email,$newUser->naam );
            //Insert userId + boluserId in BolApi
            $bolApi = new bolApi();
            $bolApi->userId = $userId->userId;
            $bolApi->userIdApi = $userIdBol;
            $bolApi->block = false;
            $bolApi->save();

            return back()->with(['succes'=> "Account succesvol aangemaakt"]);
        }
    }
    //Gnereer automatisch wachtwoord (Hash)
// Er be staat een laravel functie foor -Minty Pawel :)   https://laravel.com/docs/9.x/helpers#method-str-random
    public function createToken() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = [];
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 30; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = implode($pass);
        return password_hash($password, PASSWORD_DEFAULT);
    }


    //Stuur mail met rest wachtwoord
    public function resetPass(){
        if(isset($_POST['resetpassword']))
        {
            $email = $_POST['username'];
            $getUser = User::where('email', '=', $email)->first();
            if(!empty($getUser))
            {
                $passwordToken = $this->createToken();
                $mailSender = new MailController();
                $mailSender->resetPassword($passwordToken, $email);
                $getUser->token = $passwordToken;
                $getUser->save();
                return back()->with(['succes'=> 'E-mail is verzonden']);
            }
            else return redirect('auth/passwords/resettest')->with(['error'=> "Geberuiker niet gevonden"]);
        }
    }

    //Haal gebruiker op dmv cookie token (bij het inloggen)
    public static function getByCookie(){
        $cookieToken = ((isset($_COOKIE['user']) )) ? $_COOKIE['user'] : '';
        if (empty($cookieToken)) return null;
        $getUser = User::where('cookie_token', '=', $cookieToken )->first();

        if(empty($getUser)) return null;
        return $getUser;
    }

    //Haal alle gebruikers op uit
    public function getAllUsers(){
        $allUsers= DB::table('user')
            ->leftJoin('statusdetails', 'user.userId','=','statusdetails.userId')->get();

        //return view('bootstrTesttt')->with(['allegebruikers'=> $allUsers]);


        return view('designv2/alleGebruikers')->with(['allegebruikers'=> $allUsers]);
    }

    //Haal gebruiker op uit FS -> dmv bestaande Factuurid
    public function getFactuursturenUser(){
        $fSApi = new fsnl_api_Controller();
        if(isset($_POST['btnFactuurId'])) $UserId = $_POST['factuurId'];

        $opgehaaldeGberuiker = $fSApi->getFactuursturenUser($UserId);
        $fsClient = json_decode($opgehaaldeGberuiker);
        $fsClient = $fsClient->client;

        $this->insertUser($fsClient);
        return back();
    }

    //Insert bestaande gebruiker uit FS.
    public function insertUser($FsUser){
        $newUser = new User();
        $newUser->email = $FsUser->email;
        $newUser->naam = $FsUser->contact;
        $newUser->password = $this->createToken();
        $newUser->telefoonnummer = $FsUser->phone;
        $newUser->bedrijfsnaam = $FsUser->company;
        $newUser->btwNummer = $FsUser->taxnumber;
        //NOG AANPASSEN ADRES -> ADRESS GEEN TAX
        $newUser->adres = $FsUser->taxnumber;
        $newUser->postcode = $FsUser->zipcode;
        $newUser->plaats = $FsUser->city;
        $newUser->save();

        $newStatus = new statusdetails();
        $newStatus->userId = $newUser->userId;
        $newStatus->geverifieerd = 0;
        $newStatus->geabonneerd =0;
        $newStatus->API=0;
        $newStatus->wordpress=0;
        $newStatus->server=0;
        $newStatus->geldig="2022-01-01";
        $newStatus->save();

        $statusdetails = new factuursturen();
        $statusdetails->userId = $newUser->userId;
        $statusdetails->factuurId = $FsUser->clientnr;
        $statusdetails->save();

    }

    //Verwijder gebruiker uit alle tables
    public function deleteUser($userId){
        DB::table('user')->where('userId', '=', $userId)->delete();
        DB::table('bolApi')->where('userId', '=', $userId)->delete();
        DB::table('descriptionBolAccount')->where('userId', '=', $userId)->delete();
        DB::table('factuursturen')->where('userId', '=', $userId)->delete();
        DB::table('statusdetails')->where('userId', '=', $userId)->delete();

        return $this->getAllUsers();
    }

    //Create bol user
    public function createBolUser(Request $request, $userId){
        $CheckUserLogin = bolApi::Where('userId', '=', $userId)->first();
        $userIdApi = $CheckUserLogin->userIdApi;

        if(isset($_POST['createBolUserBTN'])) {
            $clientId = $_POST['clientId'];
            $secret = $_POST['secret'];
            $label = $_POST['land'];
            $description = $_POST['description'];
            if ($label == 'nl')$country = 'Netherlands';
            else if ($label == 'be')$country = 'Belgium';
            else if ($label == 'nl-be')$country = 'Netherlands & Belgium';
            else return back()->with(['error'=> "Kies het land waaruit u werkt voor u verder gaat"]);
        }
        $MintyBolApi = new MintyBolController();
        $newBolUser = $MintyBolApi->CreateBolAccount($userIdApi, $clientId, $secret, $country, $label );
        if (empty($newBolUser->bolUserId))return back()->with(['error'=> "Gegevens onjuist"]);

        DB::insert('insert into descriptionBolAccount(bolId, userId, description)
                values (?,?,?)',[$newBolUser->bolUserId, $userId,$description]);

        return back();
    }


    //Create Woo user
    public function createWooUser(Request $request, $userId){
        $CheckUserLogin = bolApi::Where('userId', '=', $userId)->first();
        $userIdApi = $CheckUserLogin->userIdApi;

        if(isset($_POST['createWooUserBTN'])) {
            $host = $_POST['wooClientHost'];
            if (!filter_var($host, FILTER_VALIDATE_URL)) return back()->with(['error'=> "Url is ongeldig"]);
            $key = $_POST['wooClientKey'];
            $secret = $_POST['wooClientSecret'];
        }
        $MintyBolApi = new MintyBolController();
        return $MintyBolApi->CreateWooAccount($userIdApi,$host, $key, $secret );

        //return back()->with(['error'=> "Wachtwoord komt niet overeen"]);
    }

    //Maak gebruiker aan in Factuursturen (na eerste betaling/ mandaat )
    public function createUserFS($bankcode, $biccode, $mollieId){
        $fsApi = new fsnl_api_Controller();
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();

        $getUser = User::where('userId', '=', $loggedUser->userId)->first();

        $fSApi = new fsnl_api_Controller();
        $references = "fs_bol_".$loggedUser->userId;

        $newClient = [
            'contact' => $getUser->naam,
            'showcontact' => true,
            'company' => $getUser->bedrijfsnam,
            'address' => $getUser->adres,
            'zipcode' => $getUser->postcode,
            'city' => $getUser->plaats,
            'country' => '146',
            'phone' => $getUser->telefoonnummer,
            'mobile' => $getUser->telefoonnummer,
            'email' => $getUser->email,
            'bankcode' => $bankcode,
            'biccode' => $biccode,
            'mollie_cst' => $mollieId,
            'taxnumber' => $getUser->btwNummer,
            'tax_shifted' => false,
            'sendmethod' => 'email',
            'paymentmethod' => 'autocollect',
            'top' => 14,
            'active' => true,
            'default_doclang' => 'nl',
            'email_reminder' => $getUser->email,
            'currency' => 'EUR',
            'tax_type' => 'extax',
            'reference' => $references
        ];

        $factuurid = $fSApi->CreateNewClient($newClient);
        //Insert factuurid bij bijbehorende klantid.
        if(!empty($factuurid)){
            DB::table('factuursturen')->insert([
                'userId' => $getUser->userId,
                'factuurId' => $factuurid,
                'factuur_reference' => "BOLLERT_CUID_".$loggedUser->userId
            ]);
//            DB::insert('insert into factuursturen (userId, factuurId, factuur_reference)
//                values (?,?)',[$getUser->userId, $factuurid],$references );
        }
        else dd("Er is een fout opgetreden!");
        //Haal prijs op uit db
        $bolprijs = DB::table('dynamisch')
            ->where('bolprijs', '>', 0)->first();

        //Functie om automatisch elke maand een factuur te sturen
        $fsApi->createFactuurFS($factuurid, $loggedUser->userId, $bolprijs);
        return back();
    }

    public function inloggenAlsKlant($userIdKlantAccount){
        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();
        $getUser = User::where('userId', '=', $loggedUser->userId)->first();

        //Als je geen rechten hebt tot deze functie
        if($getUser->rol === 1){
            setcookie("adminSessie", FALSE, time() + (86400 * 30),"/");
            $currentCookieToken = $getUser->cookie_token;
            $cookie_name = "adminSessie";
            setcookie("adminSessie", $currentCookieToken, time() + (86400 * 30),"/");
        }
        //Haal cookieToken op van klant.
        $GegevensKlant = User::where('userId', '=', $userIdKlantAccount)->first();

        $cookieTokenKlant = $GegevensKlant->cookie_token;
        //Als er geen cookie is -> maak er een (zodat hij niet crasht)
        if (empty($cookieTokenKlant)){
            $GegevensKlant->cookie_token = bin2hex(random_bytes(20));
            $GegevensKlant->save();
        }
        setcookie('userName', $GegevensKlant->naam, time()+3600, '/');
//        $cookie_name = 'userNameKlant';
//        setcookie($cookie_name, "", time() - (86400 * 50));
//
//        setcookie('userNameKlant', $GegevensKlant->naam, time() +(86400 * 30));


        setcookie("user", FALSE, time() + (86400 * 30),"/");
        $cookie_name = "user";
        setcookie($cookie_name, $GegevensKlant->cookie_token, time() + (86400 * 30),"/");

        return redirect()->route('dashboard');
        //return redirect()->route('dashboardv2')->with(['userByCookie'=> $GegevensKlant]);
        return view('designv2/persoonsgegevens', ['userByCookie' => $GegevensKlant]);
        return view('dashboard/dashboard', ['userByCookie' => $GegevensKlant]);
    }

    public function herstellenEigenAccountInlog(){
        if(isset($_COOKIE['adminSessie'])){
            setcookie("user", FALSE, time() + (86400 * 30),"/");
            $cookieToken = $_COOKIE['adminSessie'];

            $eigenAccount = User::where('cookie_token', '=', $cookieToken)->first();
            setcookie('userName', $eigenAccount->naam, time()+3600, '/');

            setcookie("user", $cookieToken, time() + (86400 * 30),"/");
            setcookie("adminSessie", FALSE, time() + (86400 * 30),"/");

            return redirect()->route('dashboard');
            return view('designv2/home', ['userByCookie' => $eigenAccount]);
            return view('dashboard/dashboard', ['userByCookie' => $eigenAccount]);
        }
        return back();
    }

    public function getUserInvoice($fsID){
        $fSApi = new fsnl_api_Controller();
        return $fSApi->GetAllInvoiceSingleCustomer($fsID);
    }

    public function UpdateUserDetails(){

        $homeController = new HomeController();
        $loggedUser = $homeController->renderPersonalDetails();

        $naam = $_POST['naam'];
        $Email = $_POST['email'];
        $Telf = $_POST['telefoonnummer'];
        $Bedrijfsnaam = $_POST['bedrijfsnaam'];
        $BTW = $_POST['btw'];
        $Adres = $_POST['adres'];
        $Postcode = $_POST['postcode'];
        $Plaats = $_POST['plaats'];


        $newUser = User::where('userId', '=', $loggedUser->userId)->first();

        $newUser->naam = $naam;
        $newUser->email = $Email;
        $newUser->telefoonnummer = $Telf;
        $newUser->btwNummer = $BTW;
        $newUser->adres = $Adres;
        $newUser->postcode = $Postcode;
        $newUser->plaats = $Plaats;

        $newUser->save();

        return back();
        dump($naam, $Email, $Telf, $Bedrijfsnaam, $BTW, $Adres, $Postcode, $Plaats);
        dd("ss");

    }

}
