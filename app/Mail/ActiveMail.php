<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActiveMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($active_link, $name, $password, $username)
    {
        $this->active_link = $active_link;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Kích hoạt tài khoản mới')
                    ->view('mail.active')
                    ->with([
                        'active_link' => $this->active_link,
                        'name' => $this->name,
                        'username' => $this->username,
                        'password' => $this->password,
                    ]);
    }
}
