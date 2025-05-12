<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_paises extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('paises')->insert([
            'nombre' => 'Alemania',
            'clave' => 'DE',
            'status' => 1,
        ]);

        \DB::table('paises')->insert([
            'nombre' => 'España',
            'clave' => 'ES',
            'status' => 1,
        ]);

        \DB::table('paises')->insert([
            'nombre' => 'Estados Unidos',
            'clave' => 'US',
            'status' => 1,
        ]);

        \DB::table('paises')->insert([
            'nombre' => 'México',
            'clave' => 'MX',
            'status' => 1,
        ]);
    }
}
