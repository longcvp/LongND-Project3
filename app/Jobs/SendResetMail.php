<?php

namespace App\Jobs;

use Mail;
use App\Mail\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendResetMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($password, $user)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(60);

        echo 'Start send email';
        
        $email = new ResetPassword($this->password, $this->user->username);
        Mail::to($this->user->email)->send($email);

        echo 'End send email';
    }
}
