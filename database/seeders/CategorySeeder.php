<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'apéritif'],
            ['name' => 'entrée'],
            ['name' => 'plat'],
            ['name' => 'dessert'],
            ['name' => 'fromages'],
            ['name' => 'fruits']
        ];

        $images = [
            [
                "path" => "aperitif.jpg",
                "imageable_id" => 1,
                "imageable_type" => Category::class,
            ],
            [
                "path" => "entree.jpg",
                "imageable_id" => 2,
                "imageable_type" => Category::class,
            ],
            [
                "path" => "plat.jpg",
                "imageable_id" => 3,
                "imageable_type" => Category::class,
            ],
            [
                "path" => "dessert.jpg",
                "imageable_id" => 4,
                "imageable_type" => Category::class,
            ],
            [
                "path" => "fromage.jpg",
                "imageable_id" => 5,
                "imageable_type" => Category::class,
            ],
            [
                "path" => "fruit.jpg",
                "imageable_id" => 6,
                "imageable_type" => Category::class,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        foreach ($images as $image) {
            Image::create($image);
        }




    }
}
