<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Invitacion extends Mailable
{
    use Queueable, SerializesModels;
    public $evento;
    public $usuarioInvitador;

    /**
     * Create a new message instance.
     */
    public function __construct($evento) {
        $this->evento = $evento;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitación Eventify' ,
        );
    }

    /**
     * Get the message content definition.
     */
      public function content(): Content
    {
        return new Content(
            view: 'emails.invitacion_evento',
            with: ['evento' => $this->evento],
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
