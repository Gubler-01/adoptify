<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_tipos_animales extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $var[1] = 'Perro';
        $var[2] = 'Gato';
        $var[3] = 'Conejo';
        $var[4] = 'Hamster';
        $var[5] = 'Ave';

        for ($i = 1; $i <= 5; $i++) {
            \DB::table('tipos_animales')->insert([
                'nombre' => $var[$i],
                'status' => 1,
            ]);
        }
    }
}
