<?php

namespace App\Listeners;

use App\Events\OffreEditedEvent;
use App\Mail\OffreEditedMail;
use Illuminate\Support\Facades\Mail;

class OffreEditedListener
{
    /**
     * Handle the event.
     */
    public function handle(OffreEditedEvent $event): void
    {
        Mail::send(new OffreEditedMail($event->offre));
    }
}
