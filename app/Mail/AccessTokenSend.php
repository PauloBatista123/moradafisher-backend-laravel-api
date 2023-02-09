<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccessTokenSend extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $access_token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $access_token)
    {
        $this->user = $user;
        $this->access_token = $access_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('moradafisher@moradafisher.com.br')->markdown('admin.token')->with(['user' => $this->user, 'access_token' => $this->access_token]);
    }
}
