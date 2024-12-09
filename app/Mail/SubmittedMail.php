<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubmittedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $apply_id;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $apply_id)
    {
        $this->name = $name;
        $this->email = $email;
        $this->apply_id = $apply_id;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Application Submitted Successfully')
                    ->view('email')
                    ->with([
                        'name' => $this->name,
                        'email' => $this->email,
                        'apply_id' => $this->apply_id,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Submitted Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
