<?php

namespace App\Listeners;

use App\Events\OffreValidatedEvent;
use App\Mail\OffreValidatedMail;
use Illuminate\Support\Facades\Mail;

class OffreValidatedListener
{
    /**
     * Handle the event.
     */
    public function handle(OffreValidatedEvent $event): void
    {
        Mail::send(new OffreValidatedMail($event->offre));
    }
}
