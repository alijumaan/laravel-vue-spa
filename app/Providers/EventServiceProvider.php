<?php

namespace App\Providers;

use App\Events\ExtinguisherExpiredPeriod;
use App\Listeners\RevokeOldTokens;
use App\Models\Building;
use App\Observers\BuildingObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\Events\AccessTokenCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ExtinguisherExpiredPeriod::class => [
            SendEmailVerificationNotification::class,
        ],
        AccessTokenCreated::class => [
            RevokeOldTokens::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Building::observe(BuildingObserver::class);
    }
}
