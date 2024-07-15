<?php

namespace App\View\Components;

use App\Models\Event;
use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\View\Component;

class ReservationButton extends Component
{
    public Event $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function render(): View|Factory|Application|Htmlable|Closure|string|\Illuminate\View\View
    {
        return view('components.reservation-button');
    }

    public function buttonText(): string
    {
        return match ($this->event->status->status) {
            'request' => 'Reservation Request',
            'open' => 'Create Reservation',
            'waitlist' => 'Join Waitlist',
            'full' => 'Event Full',
            default => 'N/A',
        };
    }

    public function buttonClass(): string
    {
        return match ($this->event->status->status) {
            'request', 'open', 'waitlist' => 'bg-green-500 hover:bg-green-600 text-white',
            'full', 'cancelled' => 'bg-red-500 text-white cursor-not-allowed',
            default => 'bg-gray-500 text-white cursor-not-allowed',
        };
    }

    public function buttonDisabled(): bool
    {
        return in_array($this->event->status->status, ['full', 'cancelled']);
    }
}

