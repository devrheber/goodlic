<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;

class AppointmentBookingMentorEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $appointment;
    public $email_templates;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
        $email_templates = DB::table('email_templates')->find(2);
        $this->email_templates = $email_templates->value;

        $this->email_templates = str_replace('[consultant_first_name]', $appointment->mentor->first_name ?? '', $this->email_templates);
        $this->email_templates = str_replace('[consultant_last_name]', $appointment->mentor->last_name ?? '', $this->email_templates);
        $this->email_templates = str_replace('[user_first_name]', $appointment->mentee->first_name ?? '', $this->email_templates);
        $this->email_templates = str_replace('[user_last_name]', $appointment->mentee->last_name ?? '', $this->email_templates);
        $this->email_templates = str_replace('[user_email]', $appointment->mentee->email  ?? '', $this->email_templates);
        $this->email_templates = str_replace('[appointment_date]', $appointment->date   ?? '', $this->email_templates);
        $this->email_templates = str_replace('[appointment_start_time]', $appointment->time   ?? '', $this->email_templates);
        $this->email_templates = str_replace('[appointment_end_time]', $appointment->end_time   ?? '', $this->email_templates);
        $this->email_templates = str_replace('[appointment_type_name]', $appointment->appointment_type_string   ?? '', $this->email_templates);
        $this->email_templates = str_replace('[consultant_name]', $appointment->mentor->first_name  ?? '', $this->email_templates);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.appointment_booking_mentor');
    }
}
