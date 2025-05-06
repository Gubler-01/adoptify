<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_catalogo_vacunas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $var[1] = 'Rabia';
        $var[2] = 'Parvovirus';
        $var[3] = 'Moquillo';
        $var[4] = 'Leptospirosis';
        $var[5] = 'Hepatitis Canina';

        for ($i = 1; $i <= 5; $i++) {
            \DB::table('catalogo_vacunas')->insert([
                'nombre' => $var[$i],
                'status' => 1,
            ]);
        }
    }
}
