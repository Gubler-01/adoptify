<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_roles_usuario extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $var[1] = 'Administrador';
        $var[2] = 'Refugio';
        $var[3] = 'Adoptante';

        for ($i = 1; $i <= 3; $i++) {
            \DB::table('roles_usuarios')->insert([
                'nombre' => $var[$i],
                'status' => 1,
            ]);
        }
    }
}
