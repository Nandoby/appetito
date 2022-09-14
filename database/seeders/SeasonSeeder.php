<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasons = [
            ['name' => 'printemps'],
            ['name' => 'été'],
            ['name' => 'automne'],
            ['name' => 'hiver']
        ];

        foreach ($seasons as $season) {
            Season::create($season);
        }
    }
}
