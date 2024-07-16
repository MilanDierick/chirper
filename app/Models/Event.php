<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    // Assume statuses are an array of strings
    public function getStatusesAttribute(): array
    {
        // Example statuses; replace with actual logic
        return ['bookable', 'remember', 'waitlist'];
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
}
