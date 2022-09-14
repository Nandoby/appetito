<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $difficulties = [
            ['name' => 'facile'],
            ['name' => 'moyen'],
            ['name' => 'difficile']
        ];

        foreach ($difficulties as $difficulty) {
            Difficulty::create($difficulty);
        }
    }
}
