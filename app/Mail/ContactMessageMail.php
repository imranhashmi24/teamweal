<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $msg_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user = null, $msg_data)
    {
        $this->user = $user ?? auth()->user();
        $this->msg_data = $msg_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = env('MAIL_FROM_NAME', 'Support');
        $address = env('MAIL_FROM_ADDRESS', 'demo@mail.com');
        $subject = 'A New Reply from ' . env('APP_ENV');

        return $this->view('emails.contact-message-reply-mail')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with([
                'company_address' => $address,
            ]);
    }
}
