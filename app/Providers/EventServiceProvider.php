<?php

namespace App\Providers;

use App\Events\TourCreated;
use App\Events\TourDeleted;
use App\Events\TourEdited;
use App\Events\TravelCreated;
use App\Events\TravelDeleted;
use App\Events\TravelEdited;
use App\Listeners\ClearToursCache;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TourCreated::class => [
            ClearToursCache::class,
        ],
        TourEdited::class => [
            ClearToursCache::class,
        ],
        TourDeleted::class => [
            ClearToursCache::class,
        ],
        TravelCreated::class => [
            ClearToursCache::class,
        ],
        TravelEdited::class => [
            ClearToursCache::class,
        ],
        TravelDeleted::class => [
            ClearToursCache::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
