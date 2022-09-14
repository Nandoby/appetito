<?php

namespace Database\Seeders;

use App\Models\Mesure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MesureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mesures = [
            ['name' => 'pce'],
            ['name' => 'ml'],
            ['name' => 'cl'],
            ['name' => 'l'],
            ['name' => 'g'],
            ['name' => 'mg']
        ];

        foreach ($mesures as $mesure) {
            Mesure::create($mesure);
        }
    }
}
