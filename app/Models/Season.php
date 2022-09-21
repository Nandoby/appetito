<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Season extends Model
{
    use HasFactory;

    /**
     * Get the season's recipes
     *
     * @return HasMany
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
