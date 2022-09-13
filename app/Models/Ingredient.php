<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    use HasFactory;

    /**
     * Get the ingredient's foods
     *
     * @return BelongsToMany
     */
    public function foods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class);
    }

    /**
     * Get the ingredient's mesure
     *
     * @return BelongsTo
     */
    public function mesure(): BelongsTo
    {
        return $this->belongsTo(Mesure::class);
    }
}
