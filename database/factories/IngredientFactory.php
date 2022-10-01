<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\Ingredient;
use App\Models\Mesure;
use Database\Seeders\FoodSeeder;
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

    public function configure()
    {
        return $this->afterCreating(function(Ingredient $ingredient){
            $foods = Food::all();
            $ingredient->foods()->save($foods->random());
        });
    }


}
