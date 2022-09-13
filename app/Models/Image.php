<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    /**
     * Get the parent imageable model (recipe, food, user, ...)
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
