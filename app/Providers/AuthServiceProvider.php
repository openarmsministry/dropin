<?php

namespace App\Providers;

use App\Guest;
use App\OpenarmsSession;
use App\Policies\GuestPolicy;
use App\Policies\OpenarmsSessionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Guest::class => GuestPolicy::class,
        OpenarmsSession::class => OpenarmsSessionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
