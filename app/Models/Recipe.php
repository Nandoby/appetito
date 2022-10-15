<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Recipe extends Model
{
    use HasFactory;

    /**
     * Get the recipe's category
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the recipe's comments
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the recipe's difficulty
     *
     * @return BelongsTo
     */
    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    /**
     * Get the recipe's images
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the recipe's season
     *
     * @return BelongsTo
     */
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    /**
     * Get the recipe's user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }


    /**
     * Permet d'afficher le temps de préparation en heures et en minutes
     * (dans la base de données tout est stocké en secondes)
     *
     * @param $value
     * @return string
     */
    public function getTimeAttribute($value): string
    {
        $seconds = $value;

        $seconds = round($seconds);
        $output = str_replace('00 h','',sprintf('%02d h %02d m', ($seconds/3600), ($seconds/ 60 % 60)));
        return $output;
    }

    public function timeEdit()
    {
        $time = $this->time;
        $time = str_replace(' ', '', $time);

        if (strlen($time) < 5) {

            $time = str_replace('m','', $time);

            $time = '00:'.$time;

            return $time;
        }

        $time = str_replace([' ','h','m'],['',':',''] ,$this->time);

        return $time;
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }

    public function averageRatings(): string
    {
        $ratings = number_format($this->comments->avg('rating'), 2);

        return $ratings;
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }


}
