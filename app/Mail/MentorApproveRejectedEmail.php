<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class MentorApproveRejectedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $email_templates;
    public $mentor;
    public $mentor_status;

    public function __construct($user,$mentor)
    {
        $this->user = $user;
        $this->mentor = $mentor;
        if ($this->mentor->status == 1) {
            $email_templates = DB::table('email_templates')->find(5);
            $this->mentor_status = "Approved";
        }
        if ($this->mentor->status == 2) {
            $email_templates = DB::table('email_templates')->find(6);
            $this->mentor_status = "Rejected";
        }
        $this->email_templates = $email_templates->value;
        $this->email_templates = str_replace('[consultant_first_name]', $mentor->first_name ?? '', $this->email_templates);
        $this->email_templates = str_replace('[consultant_last_name]', $mentor->last_name ?? '', $this->email_templates);
        $this->email_templates = str_replace('[accepted_status]', $this->mentor_status ?? '', $this->email_templates);
        $this->email_templates = str_replace('[rejected_status]', $this->mentor_status ?? '', $this->email_templates);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->mentor->status == 1) {
            return $this->subject('Consultant Approved Successfully ')->view('email.mentor_approve');
        }else if($this->mentor->status == 2){
            return $this->subject('Consultant Profile Rejected ')->view('email.mentor_rejected');
        }
        else{
            return $this->subject('Consultant Profile Status Update ')->view('email.mentor_approve');
        }
    }

}
