<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tabla_municipios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $var[1] = 'Toluca';
        $var[2] = 'Metepec';
        $var[3] = 'Xonacatlán';
        $var[4] = 'Lerma';
        $var[5] = 'San Mateo Atenco';
        $var[6] = 'Zinacantepec';
        $var[7] = 'Almoloya de Juárez';
        $var[8] = 'Calimaya';
        $var[9] = 'Capulhuac';
        $var[10] = 'Ocoyoacac';
        $var[11] = 'Huixquilucan';
        $var[12] = 'Tianguistenco';
        $var[13] = 'Temoaya';
        $var[14] = 'Rayón';
        $var[15] = 'Chapultepec';

        for ($i = 1; $i <= 15; $i++) {
            \DB::table('municipios')->insert([
                'id_entidad' => 15, // Estado de México
                'nombre' => $var[$i],
                'status' => 1,
            ]);
        }
    }
}
