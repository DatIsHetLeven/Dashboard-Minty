<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//Ongebruikte class - minty pawel
use App\Http\Controllers\MailController;

//Dubblele class naam - minty pawel
class ResetPass extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($passtoken)
    {
        $this->token = $passtoken;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('/auth/mail/password', ['token' => $this->token]);
    }
}
