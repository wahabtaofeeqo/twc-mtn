<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class QrcodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $qrCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $qrCode)
    {
        $this->user = $user;
        $this->qrCode = $qrCode;
    }
 
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'MTN Sales Conference',
            from: new Address('no-reply@mtnconference.com', 'Planning Committee'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.qrcode-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
