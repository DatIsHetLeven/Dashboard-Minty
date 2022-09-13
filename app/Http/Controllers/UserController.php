<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use routes\web;
use app\Models\User;

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
            $email = $_POST['email'];
            $naam = $_POST['userName'];
            $telefoonnummer = $_POST['Telefoonnummer'];
            $bedrijfsnaam = $_POST['Bedijfsnaam'];
            $btwNummer = $_POST['BTW-Nummer'];
            $adres = $_POST['Adres + Huisnummer'];
            $postcode = $_POST['Postcode'];
            $plaats = $_POST['Plaats'];

            DB::insert('insert into users(email, naam, password, telefoonnummer, bedrijfsnaam, btwNummer, adres, postcode, plaats)
                    values($email, $naam, $telefoonnummer, $bedrijfsnaam, $btwNummer, $adres, $postcode, $plaats)');

            
        }
    }
}
