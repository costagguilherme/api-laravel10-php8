<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOtpEmail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(public string $otp)
    {
    }

    public function build()
    {
        $this->subject('Seu OTP')->view('send_email');
    }


    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Send Otp Email',
    //     );
    // }

    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'send_email',
    //     );
    // }
}
