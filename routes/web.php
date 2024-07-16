<?php

use App\Http\Controllers\ChildController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

// redirect to /events
Route::get('/', fn() => redirect()->route('events.index'));

Route::get('/test-logging', function () {
    Log::info('Test log statement.');

    return 'Log statement added';
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
     ->only(['index', 'store', 'edit', 'update', 'destroy', 'show'])
     ->middleware(['auth', 'verified']);

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('events', EventController::class)->except(['index', 'show']);

    Route::post('/events/{event}/export', [EventController::class, 'export'])
         ->name('events.export')
         ->middleware(['auth', 'verified']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/children', [ChildController::class, 'index'])->name('children.index');
    Route::get('/children/create', [ChildController::class, 'create'])->name('children.create');
    Route::post('/children', [ChildController::class, 'store'])->name('children.store');
    Route::get('/children/{child}/edit', [ChildController::class, 'edit'])->name('children.edit');
    Route::put('/children/{child}', [ChildController::class, 'update'])->name('children.update');
    Route::patch('/children/{child}', [ChildController::class, 'update']);
    Route::delete('/children/{child}', [ChildController::class, 'destroy'])->name('children.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('reservations', ReservationController::class)->only(['store']);
});

require __DIR__.'/auth.php';
