<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Picture>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $imageable = $this->faker->randomElement([
            [
                'id' => User::all()->random()->id,
                'type' => User::class
            ],
            [
                'id' => Recipe::all()->random()->id,
                'type' => Recipe::class
            ],

        ]);

        return [
            'path' => "https://picsum.photos/id/".rand(1,50)."/600/600",
            'imageable_id' => $imageable['id'],
            'imageable_type' => $imageable['type']
        ];
    }
}
