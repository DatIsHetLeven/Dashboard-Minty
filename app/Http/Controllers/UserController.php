<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use routes\web;
use App\Models\User;

class UserController extends Controller
{
    //Haal inlog gebruiker op
    public function getUser()
    {
        if(isset($_POST['loginButton']))
        {
            $username = $_POST['userName'];
            $password = $_POST['password'];

            $CheckUserLogin = DB::table('user')
                        ->where('naam', '=', $username)
                        ->where('password', '=', $password)
                        ->first();

            if(!empty ($CheckUserLogin))
            {
                //Gelukt
                return redirect('/dashboard');
            }
            else{
                return redirect('/test  ');
            }
        }
    }

    //Create user
    public function createUser()
    {
        if(isset($_POST['buttonregister']))
        {
            $newUser = new User();
            $newUser->email = $_POST['email'];
            $newUser->naam = $_POST['userName'];
            
            // $newUser->password = $_POST['password'];
            $newUser->password = $this->randomPassword();
            $newUser->telefoonnummer = $_POST['Telefoonnummer'];
            $newUser->bedrijfsnaam = $_POST['Bedijfsnaam'];
            $newUser->btwNummer = $_POST['BTW-Nummer'];
            $newUser->adres = $_POST['BTW-Nummer'];
            $newUser->postcode = $_POST['Postcode'];
            $newUser->plaats = $_POST['Plaats'];

            $newUser->save();
        }
    }
    //Gnereer automatisch wachtwoord
    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
    

    
}
