<?php

namespace Database\Factories;

use App\Models\Mesure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantity' => rand(1, 100),
            'mesure_id' => Mesure::all()->random()->id
        ];
    }
}
