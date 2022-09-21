<?php

namespace Database\Seeders;

use App\Models\Image;
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

        $images = [
            [
                'path' => 'printemps.jpg',
                'imageable_id' => 1,
                'imageable_type' => Season::class,
            ],
            [
                'path' => 'ete.jpg',
                'imageable_id' => 2,
                'imageable_type' => Season::class,
            ],
            [
                'path' => 'automne.jpg',
                'imageable_id' => 3,
                'imageable_type' => Season::class,
            ],
            [
                'path' => 'hiver.jpg',
                'imageable_id' => 4,
                'imageable_type' => Season::class,
            ],
        ];

        foreach ($seasons as $season) {
            Season::create($season);
        }

        foreach ($images as $image) {
            Image::create($image);
        }
    }
}
