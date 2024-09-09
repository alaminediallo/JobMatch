<?php

namespace App\Listeners;

use App\Events\OffreCreatedEvent;
use App\Mail\OffreCreatedMail;
use Illuminate\Support\Facades\Mail;

class OffreCreatedListener
{
    /**
     * Handle the event.
     */
    public function handle(OffreCreatedEvent $event): void
    {
        Mail::send(new OffreCreatedMail($event->offre));
    }
}
