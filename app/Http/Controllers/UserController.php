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
}
