<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $foods = [
            ['name' => 'abricot',],
            ['name' =>'agneau'],
            ['name' => 'ail'],
            ['name' => 'bacon'],
            ['name' => 'bagel'],
            ['name' => 'baguette'],
            ['name' => 'banane'],
            ['name' => 'cacao'],
            ['name' => 'café'],
            ['name' => 'calamar'],
            ['name' => 'datte'],
            ['name' => 'dinde'],
            ['name' => 'dorade'],
            ['name' => 'faisan'],
            ['name' => 'farine'],
            ['name' => 'gambas'],
            ['name' => 'gaufre'],
            ['name' => 'haché de veau'],
            ['name' => 'halloumi'],
            ['name' => 'hareng'],
            ['name' => 'haricot'],
            ['name' => 'jambon'],
            ['name' => 'kaki'],
            ['name' => 'ketchup'],
            ['name' => 'lait'],
            ['name' => 'madeleine'],
            ['name' => 'oeuf'],
            ['name' => 'orange'],
            ['name' => 'pain'],
            ['name' => 'quinoa'],
            ['name' => 'radis'],
            ['name' => 'safran'],
            ['name' => 'sel'],
            ['name' => 'salade'],
            ['name' => 'tabasco'],
            ['name' => 'taleggio'],
            ['name' => 'veau'],
            ['name' => 'wasabi'],
            ['name' => 'whisky'],
            ['name' => 'yaourt'],
        ];

        $images = [];
        $index = 1;


        foreach ($foods as $food) {
            Food::create($food);

            $images[] = [
                'path' => str_replace(' ', '-', $food['name']) . '.jpg',
                'imageable_id' => $index,
                'imageable_type' => Food::class
            ];

            $index++;
        }

        foreach ($images as $image) {
            Image::create($image);
        }



    }
}
