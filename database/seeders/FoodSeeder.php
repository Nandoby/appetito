<?php

namespace Database\Seeders;

use App\Models\Food;
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

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
