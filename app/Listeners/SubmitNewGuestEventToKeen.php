<?php

namespace App\Listeners;

use App\Events\NewGuestRegistered;
use App\Keen\Transformers\GuestToNewGuestTransformer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmitNewGuestEventToKeen
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewGuestRegistered  $event
     * @return void
     */
    public function handle(NewGuestRegistered $event)
    {
        $guest = $event->getPayload();
        $transformer = new GuestToNewGuestTransformer($guest);
        \Keen::addEvent('new_guest', $transformer->transform());
    }
}
