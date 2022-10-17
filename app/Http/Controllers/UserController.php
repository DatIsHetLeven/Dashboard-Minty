<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\statusdetails;
use App\Models\factuursturen;
use App\Models\bolApi;



//De classes hier onder worden niet gebruikt - minty pawel
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use App\Providers\FortifyServiceProvider;
use App\Actions\Fortify;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Connection\fsnl_api_Controller;
use App\Http\Controllers\Connection\MintyBol_API\MintyBolController;



class UserController extends Controller
{
    //Haal inlog gebruiker op
    public function getUser()
    {
        if(!isset($_POST['loginButton'])) return redirect()->route('login')->with(['error'=> "login error"]);

        $error = '';
        $username = $_POST['userName'];
        $CheckUserLogin = User::Where('email', '=', $username)->first();

        if(empty($CheckUserLogin)) return back()->with(['error'=> "Geberuiker niet gevonden"]);

        $password = password_verify($_POST['password'], $CheckUserLogin->password);

        if($password === TRUE)
        {
            //CMaak cookie token + opslaan in db
            $cookieToken = $this->createToken();
            $CheckUserLogin->cookie_token = $cookieToken;
            $CheckUserLogin->save();

            $cookie_name = "user";
            setcookie($cookie_name, $cookieToken, time() + (86400 * 30));
            return redirect()->route('dashboard');

        }
        else
        {
            $error = "Wachtwoord klopt niet!";
            return back()->with(['error'=> $error]);
        }
    }
//Request gebruiken + returns - minty pawel
    public function createPassword(Request $request)
    {
        if(isset($_POST['passwordButton']))
        {
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $resetToken = $_POST['resetToken'];

            //Check of gebruiker nog een token heeft -> wachtwoord wijzigen
            $getUser = User::where('token',  $resetToken)->first();
            if(empty($getUser)){
                return back()->with(['error'=> "Link niet meer geldig, vraag een nieuw wachtwoord aan"]);
            }

            if($password == $password2)
            {
                //Update user
                $hashPassword = password_hash($password2, PASSWORD_DEFAULT);
                $getUser->password=$hashPassword;
                $getUser->token = NULL;
                $getUser->save();
                return back()->with(['succes'=> "Wachtwoord succesvol veranderd"]);

            }else{
                return back()->with(['error'=> "Wachtwoord komt niet overeen"]);
            }
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

            $getUser = User::where('email', '=', $newUser->email)
            ->first();

            if(!empty($getUser))return back()->with(['error'=> "Email al in gebruik"]);

            if(!empty($_POST['userRole'])){
                $userRole = $_POST['userRole'];
                if($userRole ==='Proefaccount')$newUser->rol = 3;
                if($userRole ==='Admin')$newUser->rol = 1;
            }else{$newUser->rol = 3;}

            $newUser->naam = $_POST['userName'];
            $newUser->password = $this->createToken();
            $newUser->telefoonnummer = $_POST['Telefoonnummer'];
            $newUser->bedrijfsnaam = $_POST['Bedijfsnaam'];
            $newUser->btwNummer = $_POST['BTW-Nummer'];
            $newUser->adres = $_POST['BTW-Nummer'];
            $newUser->postcode = $_POST['Postcode'];
//            dubbele code  - minty pawel
            $newUser->plaats = $_POST['Plaats'];
            $newUser->plaats = $_POST['Plaats'];


            $passwordToken = $this->createToken();
            $newUser->token=$passwordToken;
            $mailSender = new MailController();
            $mailSender->sendPassword($passwordToken, $newUser->email);

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
            $userIdBol = $MintyBolApi->CreateUserBolApi($newUser->email);

            //Insert userId + boluserId in BolApi
            $bolApi = new bolApi();
            $bolApi->userId = $userId->userId;
            $bolApi->bolUserId = $userIdBol;
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
            $error = '';
            $email = $_POST['username'];
            $getUser = User::where('email', '=', $email)
                ->first();

            if(!empty($getUser))
            {
                $passwordToken = $this->createToken();
                $mailSender = new MailController();
                $mailSender->resetPassword($passwordToken, $email);
                $getUser->token = $passwordToken;
                $getUser->save();
                return back()->with(['succes'=> 'E-mail is verzonden']);
            }
            else
            {
                $error = "Geberuiker niet gevonden";
                // return redirect()->route('resetpassword')->with(['error'=> $error]);
                return redirect('auth/passwords/resettest')->with(['error'=> $error]);
            }
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
            ->leftJoin('statusdetails', 'user.userId','=','statusdetails.userId')
            ->get();
        //return view('dashboard/allegebruikers')->with(['allegebruikers'=> $allUsers]);
        return view('bootstrTesttt')->with(['allegebruikers'=> $allUsers]);
    }

    //Haal gebruiker op uit FS -> dmv bestaande Factuurid
    public function getFactuursturenUser(){
        $fSApi = new fsnl_api_Controller();

        if(isset($_POST['btnFactuurId']))
        {
            $UserId = $_POST['factuurId'];
        }
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

    //Maak gebruiker aan in Factuursturen
    public function createUserFactuursturen($id){

        $getUser = User::where('userId', '=', $id)->first();
        $fsnlAPI = new fsnl_api_Controller;

        $fSApi = new fsnl_api_Controller();
            $newClient = [];

            $newClient = [
                'contact' => $getUser->naam,
                'showcontact' => true,
                'company' => $getUser->bedrijfsnam,
                'address' => $getUser->adres,
                'zipcode' => $getUser->postcode,
                'city' => $getUser->plaats,
                // 'country' => 146,
                'phone' => $getUser->telefoonnummer,
                'mobile' => $getUser->telefoonnummer,
                'email' => $getUser->email,
                'bankcode' => 'NL91INGB0001234567',
                'biccode' => 'INGBNL2A',
                'taxnumber' => $getUser->btwNummer,
                'tax_shifted' => false,
                'sendmethod' => 'email',
                'paymentmethod' => 'bank',
                'top' => 3,
                'stddiscount' => 5.30,
                'mailintro' => 'Dear Johnny,',
                'reference' => array(
                  'line1' => 'Your ref: ABC123',
                  'line2' => 'Our ref: XZX0029/2932/001',
                  'line3' => 'Thank you for your order'
                ),
                'notes' => 'This client is always late with his payments',
                'notes_on_invoice' => false,
                'active' => true,
                'default_doclang' => 'en',
                'email_reminder' => 'reminder@mintymedia.nl',
                'currency' => 'EUR',
                'tax_type' => 'intax'
            ];
            $factuurid = $fSApi->CreateNewClient($newClient);
            //Insert factuurid bij bijbehorende klantid.
            if(!empty($factuurid)){
                DB::insert('insert into factuursturen (userId, factuurId)
                values (?,?)',[$getUser->userId, $factuurid]);
            }
            else{
                dd("Er is een fout opgetreden!");
            }


            return back();
    }
    //Verwijder gebruiker
    public function deleteUser($userId){
        DB::table('user')->where('userId', '=', $userId)->delete();
        DB::table('statusdetails')->where('userId', '=', $userId)->delete();
        DB::table('factuursturen')->where('userId', '=', $userId)->delete();

        return $this->getAllUsers();
    }










        /**
    * This function return the current loggedin user
     * @return User|null
     */
}
