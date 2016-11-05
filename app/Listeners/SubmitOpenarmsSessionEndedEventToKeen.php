<?php

namespace App\Listeners;

use App\Events\OpenarmsSessionEnded;
use App\Keen\Transformers\SessionToSessionEndedTransformer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmitOpenarmsSessionEndedEventToKeen
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
     * @param  OpenarmsSessionEnded  $event
     * @return void
     */
    public function handle(OpenarmsSessionEnded $event)
    {
        $transformer = new SessionToSessionEndedTransformer($event->getPayload());
        \Keen::addEvent('session', $transformer->transform());
    }
}
