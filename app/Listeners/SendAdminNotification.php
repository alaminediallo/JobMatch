<?php

namespace App\Listeners;

use App\Events\OffreCreated;
use App\Mail\OffreCreatedNotification;
use Illuminate\Support\Facades\Mail;

class SendAdminNotification
{
    /**
     * Handle the event.
     */
    public function handle(OffreCreated $event): void
    {
        Mail::send(new OffreCreatedNotification($event->offre));
    }
}
