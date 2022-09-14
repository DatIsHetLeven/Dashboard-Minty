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
        echo "test";
        exit();
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
            $newUser->password = $_POST['Bedijfsnaam'];
            $newUser->telefoonnummer = $_POST['Telefoonnummer'];
            $newUser->bedrijfsnaam = $_POST['Bedijfsnaam'];
            $newUser->btwNummer = $_POST['BTW-Nummer'];
            $newUser->adres = $_POST['BTW-Nummer'];
            $newUser->postcode = $_POST['Postcode'];
            $newUser->plaats = $_POST['Plaats'];

            $newUser->save();


            // DB::insert("insert into user(email, naam, password, telefoonnummer, bedrijfsnaam, btwNummer, adres, postcode, plaats)
            //         values($email, $naam, $password, $telefoonnummer, $bedrijfsnaam, $btwNummer, $adres, $postcode, $plaats)");

            
        }
    }
}
