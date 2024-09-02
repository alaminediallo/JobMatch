<?php

namespace App\Mail;

use App\Models\Offre;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OffreCreatedNotification extends Mailable
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
        $adminEmail = User::whereRelation('role', 'name', 'Administrateur')->value('email');

        return new Envelope(
            from: $this->offre->user->email,
            to: $adminEmail,
            replyTo: $this->offre->user->email,
            subject: "Nouvelle offre d'emploi créée",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'emails.offre.created',
            with: [
                'offre' => $this->offre,
            ]
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
