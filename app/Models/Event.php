<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * @property EventStatus $status
 * @property string image
 */
class Event extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'description',
        'prerequisites',
        'status_id',
        'spots',
        'spots_taken',
        'waitlist',
        'waitlist_taken',
        'status_id',
        'start',
        'end',
        'grace',
        'organizer_name',
        'organizer_email',
        'organizer_phone',
        'address',
        'mail_subject',
        'mail_body',
        'classes',
        'sorting',
        'author',
        'image',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(EventStatus::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function getClassRangeAttribute(): string
    {
        $classes = $this->classes;

        if (is_array($classes) && ! empty($classes)) {
            $cleanedClasses = array_map(function ($class) {
                return str_replace('Class ', '', $class);
            }, $classes);

            $min = min($cleanedClasses);
            $max = max($cleanedClasses);

            return "Class $min - $max";
        }

        return "Class N/A";
    }


    protected function casts(): array
    {
        return [
            'start'   => 'datetime',
            'end'     => 'datetime',
            'grace'   => 'datetime',
            'classes' => 'array',
        ];
    }

    /**
     * @throws GuzzleException
     */
    private function fetchUnsplashImage()
    {
        $client   = new Client();
        $response = $client->request('GET', 'https://api.unsplash.com/photos/random', [
            'headers' => [
                'Authorization' => 'Client-ID d5XoF-6BpWhMjvyHWWkZ2sH3L9XUDtlhUKWD5H1Zyfg',
            ],
            'query'   => [
                'query'       => 'event',
                'orientation' => 'landscape',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['urls']['regular'];  // URL of the image
    }

    /**
     * Fetches and stores an Unsplash image locally.
     *
     * @throws GuzzleException
     * @return string
     */
    public function fetchAndStoreUnsplashImage()
    {
        $imageUrl = $this->fetchUnsplashImage();

        // Get the image content
        $imageContent = file_get_contents($imageUrl);

        // Generate a unique filename based on the URL
        $filename = 'event_images/' . basename($imageUrl);

        // Store the image in the public disk
        Storage::disk('public')->put($filename, $imageContent);

        return $filename;
    }
}
