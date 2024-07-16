<?php

namespace App\Observers;

use App\Models\Event;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class EventObserver
{
    /**
     * @throws GuzzleException
     */
    public function created(Event $event): void
    {
        $this->handleImage($event);
    }

    public function updated(Event $event): void
    {
    }

    public function saved(Event $event): void
    {
    }

    public function deleted(Event $event): void
    {
    }

    public function restored(Event $event): void
    {
    }

    /**
     * @throws GuzzleException
     */
    private function handleImage(Event $event): void
    {
        // Check if the event has an image
        if ( ! $event->image) {
            try {
                // Fetch and store the Unsplash image
                $event->image = $event->fetchAndStoreUnsplashImage();
                $event->save(); // Save the event with the new image path
                Log::info('Fetched and stored Unsplash image for event ID: '.$event->id);
            } catch (\Exception $e) {
                Log::error('Failed to fetch and store Unsplash image: '.$e->getMessage());
            }
        }
    }
}
