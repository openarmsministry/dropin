<?php

namespace App\Listeners;

use App\Events\GuestCheckedIn;
use App\Keen\Transformers\AttendanceToGuestCheckedInTransformer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmitGuestCheckInEventToKeen
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
     * @param  GuestCheckedIn  $event
     * @return void
     */
    public function handle(GuestCheckedIn $event)
    {
        $transformer = new AttendanceToGuestCheckedInTransformer($event->getPayload());
        \Keen::addEvent('guest_checkin', $transformer->transform());
        \Log::info('sent to Keen for guest checkin');
    }
}
