<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Difficulty;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        $slug = Str::slug($title,'-');

        return [
            'title' => $title,
            'slug' => $slug,
            'time' => $this->faker->numberBetween(120, 7200),
            'category_id' => Category::all()->random()->id,
            'difficulty_id' => Difficulty::all()->random()->id,
            'season_id' => Season::all()->random()->id,
        ];
    }
}
