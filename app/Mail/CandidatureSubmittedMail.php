<?php

namespace App\Mail;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidatureSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Candidature $candidature, public Offre $offre)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle candidature soumise',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'emails.candidatures.submitted',
            with: [
                'nomCandidat' => $this->candidature->user->name,
                'titreOffre' => $this->offre->title,
                'nomEntreprise' => $this->offre->user->nom_entreprise,
                'nomRecruteur' => $this->offre->user->name,
                'candidatureId' => $this->candidature->id,
                'offreId' => $this->offre->id,
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
