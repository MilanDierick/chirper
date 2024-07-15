<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    public $timestamps = false;

    public function children(): HasMany
    {
        return $this->hasMany(Child::class);
    }
}
