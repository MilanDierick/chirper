<?php

namespace App\Providers;

use App\Models\Reservation;
use App\Observers\ReservationObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Nova\Nova;
use Throwable;

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
        Reservation::observe(ReservationObserver::class);

        Nova::serving(function () {
            Nova::report(function (Throwable $e, $request) {
                if ($e instanceof ValidationException) {
                    $request->session()->flash('nova.validation', json_encode($e->errors()));
                }
            });
        });
    }
}
