<?php

namespace Database\Seeders;

use App\Models\Category;
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

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
