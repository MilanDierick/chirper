<?php

namespace App\Providers;

use App\Models\Event;
use App\Observers\EventObserver;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Nova::serving(static function () {
            Event::observe(EventObserver::class);
        });
    }
}
