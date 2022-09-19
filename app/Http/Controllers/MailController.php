<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;
use App\Mail\password;
use App\Mail\ResetPass;

class MailController extends Controller
{
    public function sendPassword($token)
    {
        Mail::to('muratcelem1@hotmail.com')->send(new password($token));

        return view('welcome');
    }


    public function resetPassword($token)
    {
        Mail::to('test@hotmail.com')->send(new ResetPass($token));

        return view('welcome');
    }

}
