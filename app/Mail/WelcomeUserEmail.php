<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class WelcomeUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;
    public $email_templates;

    public function __construct($user)
    {
        $this->user = $user;
        $email_templates = DB::table('email_templates')->find(7);
        $this->email_templates = $email_templates->value;
        $this->email_templates = str_replace('[user_first_name]', $user->first_name ?? '', $this->email_templates);
        $this->email_templates = str_replace('[user_last_name]', $user->last_name ?? '', $this->email_templates);
        $this->email_templates = str_replace('[user_email]', $this->$user->email ?? '', $this->email_templates);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.welcome_user');
    }
}
