<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //   $this->LoginModel = $this->model("login");
    // }



    // Haal alle gebruikers op
    // public function getAll() {
    //     $this->query(
    //         "SELECT *
    //         FROM `user`"
    //     );

    //     return $this->processMultiple($this->resultSet());
    // }


    // public function getUser()
    // {


    //     if(isset($_POST['loginButton']))
    //     {
    //         $username = $_POST['userName'];
    //         $password = $_POST['password'];


    //         $CheckUserLogin = LoginModel->CheckUserLogin($username, $password);
    //         dd($CheckUserLogin);
    //         if($CheckUserLogin==1)
    //         {
    //             //Gelukt
    //             return require_once('views/register.blade.php');
    //         }
    //         else{
    //             return require_once('views/accounts.blade.php');
    //         }
    //     }
    //     // $this->$routeManger();
    // }

    // public function routeManger()
    // {
    //     return require_once('views/login.blade.php');
    // }



}
