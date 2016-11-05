<?php

namespace App\Providers;

use App\Events\GuestCheckedIn;
use App\Events\NewGuestRegistered;
use App\Events\OpenarmsSessionEnded;
use App\Listeners\SubmitGuestCheckInEventToKeen;
use App\Listeners\SubmitNewGuestEventToKeen;
use App\Listeners\SubmitOpenarmsSessionEndedEventToKeen;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewGuestRegistered::class => [
            SubmitNewGuestEventToKeen::class,
        ],
        OpenarmsSessionEnded::class => [
            SubmitOpenarmsSessionEndedEventToKeen::class,
        ],
        GuestCheckedIn::class => [
            SubmitGuestCheckInEventToKeen::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
