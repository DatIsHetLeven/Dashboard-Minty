<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use App\Providers\FortifyServiceProvider;
use App\Actions\Fortify;
use App\Http\Controllers\MailController;

use App\Models\User;

class UserController extends Controller
{
    //Haal inlog gebruiker op
    public function getUser()
    {
        if(isset($_POST['loginButton']))
        {
            $this->createToken(30);

            exit();


            $username = $_POST['userName'];
            $password = password_verify($_POST['password'], PASSWORD_DEFAULT);

            $CheckUserLogin = DB::table('user')
                        ->where('naam', '=', $username)
                        ->orWhere('email', '=', $username)
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

    public function createPassword(Request $request)
    {
        if(isset($_POST['passwordButton']))
        {
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $resetToken = $_POST['resetToken'];

            if($password == $password2)
            {
                //Krijg de juiste gebruiker
                $getUser = User::where('token',  $resetToken)
                ->first();
                //Update user
                $getUser->password=$password;
                $getUser->token = NULL;
                $getUser->save();
                echo "gelukt";
                
            }
            else
            {
                echo "oops";
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
            
            $newUser->password = $this->createToken();
            $newUser->telefoonnummer = $_POST['Telefoonnummer'];
            $newUser->bedrijfsnaam = $_POST['Bedijfsnaam'];
            $newUser->btwNummer = $_POST['BTW-Nummer'];
            $newUser->adres = $_POST['BTW-Nummer'];
            $newUser->postcode = $_POST['Postcode'];
            $newUser->plaats = $_POST['Plaats'];
            $newUser->plaats = $_POST['Plaats'];

            $passwordToken = $this->createToken();

            $newUser->token=$passwordToken;

            $mailSender = new MailController();
            $mailSender->sendPassword($passwordToken);

            $newUser->save();
        }
    }
    //Gnereer automatisch wachtwoord (Hash)


    public function createToken() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 30; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = (implode($pass));
        echo $password;
        return password_hash($password, PASSWORD_DEFAULT);
    }
    

    
}
