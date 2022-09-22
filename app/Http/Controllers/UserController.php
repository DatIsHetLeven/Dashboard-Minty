<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;


//De classes hier onder worden niet gebruikt - minty pawel
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use App\Providers\FortifyServiceProvider;
use App\Actions\Fortify;
use App\Http\Controllers\MailController;


class UserController extends Controller
{
    //Haal inlog gebruiker op
    public function getUser()
    {
        if(!isset($_POST['loginButton'])) return redirect()->route('login')->with(['error'=> "login error"]);

        $error = '';
        $username = $_POST['userName'];
        $CheckUserLogin = User::Where('email', '=', $username)->first();

        if(empty($CheckUserLogin)) return redirect()->route('login')->with(['error'=> "Geberuiker niet gevonden"]);

        $password = password_verify($_POST['password'], $CheckUserLogin->password);

        if($password === TRUE)
        {
            $cookie_name = "user";
            setcookie($cookie_name, $CheckUserLogin, time() + (86400 * 30));
            return redirect('/dashboard');

        }
        else
        {
            $error = "Wachtwoord klopt niet!";
            return redirect()->route('login')->with(['error'=> $error]);
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
                return redirect()->route('resetpassword')->with(['error'=> $error]);
            }
        }


    }



}
