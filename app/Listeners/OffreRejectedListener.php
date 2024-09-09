<?php

namespace App\Listeners;

use App\Events\OffreRejectedEvent;
use App\Mail\OffreRejectedMail;
use Illuminate\Support\Facades\Mail;

class OffreRejectedListener
{
    /**
     * Handle the event.
     */
    public function handle(OffreRejectedEvent $event): void
    {
        Mail::send(new OffreRejectedMail($event->offre));
    }
}
