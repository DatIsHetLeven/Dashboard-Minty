<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;

use App\Mail\password;
use App\Mail\ResetPass;

class MailController extends Controller
{
    public function sendPassword($token, $email)
    {
        Mail::to($email)->send(new password($token));

        return redirect()->route('login');
    }


    public function resetPassword($token, $email)
    {
        Mail::to($email)->send(new ResetPass($token));

        return redirect()->route('welcome');
    }

}
