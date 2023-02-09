<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordSend extends Mailable
{
    use Queueable, SerializesModels;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('moradafisher@moradafisher.com.br')->subject('Esqueci Minha Senha - Resete')->markdown('admin.mails.reset_password')->with(['token' => $this->token]);
    }
}
