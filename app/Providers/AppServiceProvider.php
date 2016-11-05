<?php

namespace App\Providers;

use App\Events\NewGuestRegistered;
use App\Guest;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Guest::created(function ($guest) {
            event(new NewGuestRegistered($guest));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
