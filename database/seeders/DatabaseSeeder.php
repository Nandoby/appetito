<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            CategorySeeder::class,
            FoodSeeder::class,
            MesureSeeder::class,
            SeasonSeeder::class,
            DifficultySeeder::class
        ]);

        User::factory()
            ->count(10)
            ->has(
                Recipe::factory()
                    ->has(
                        Ingredient::factory()
                            ->count(rand(2, 6))
                    )
            )
            ->has(
                Comment::factory()
                    ->count(rand(2, 8))
            )
            ->create();

        Image::factory()
            ->count(10)
            ->create();

    }
}
