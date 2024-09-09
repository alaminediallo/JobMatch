<?php

namespace App\Mail;

use App\Models\Offre;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OffreCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Offre $offre)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $recruteurEmail = auth()->user()->email;
        $adminEmail = User::whereRelation('role', 'name', 'Administrateur')->value('email');

        return new Envelope(
            from: $recruteurEmail,
            to: $adminEmail,
            replyTo: $recruteurEmail,
            subject: "Nouvelle offre d'emploi créée",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'emails.offres.created',
            with: [
                'offre' => $this->offre,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
