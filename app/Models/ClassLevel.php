<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassLevel extends Model
{
    public $timestamps = false;

    protected $fillable = ['level'];

    public function children(): HasMany
    {
        return $this->hasMany(Child::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_class_level');
    }
}
