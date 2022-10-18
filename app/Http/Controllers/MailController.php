<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;

// De Class password wordt nergens aangemaakt - minty pawel
use App\Mail\password;
use App\Mail\ResetPass;

class MailController extends Controller
{
    public function sendPassword($token, $email)
    {
        Mail::to($email)->send(new password($token));

        return view('welcome');
    }


    public function resetPassword($token, $email)
    {
        Mail::to($email)->send(new ResetPass($token));

        return view('welcome');
    }

}
