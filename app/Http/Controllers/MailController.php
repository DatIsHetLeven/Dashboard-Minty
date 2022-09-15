<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;
use App\Mail\password;

class MailController extends Controller
{
    public function sendPassword($token)
    {
        Mail::to('muratcelem1@hotmail.com')->send(new password($token));

        return view('welcome');
    }
}
