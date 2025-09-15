<?php

namespace App\Providers;

use App\Events\TaskRegisteredEvent;
use App\Listeners\LogTaskListener;
use App\Listeners\SendTaskEmailListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TaskRegisteredEvent::class => [
            SendTaskEmailListener::class,
            LogTaskListener::class,
        ]
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
