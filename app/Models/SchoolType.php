<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function children(): HasMany
    {
        return $this->hasMany(Child::class);
    }
}
