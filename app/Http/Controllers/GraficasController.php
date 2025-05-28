<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animales;
use App\Models\Refugios;
use App\Models\Tipos_Animales;

class GraficasController extends Controller
{
    public function graficas()
    {
        return view("graficas.selecciona_grafica");
    }

    public function grafica_barras()
    {
        $refugios = Refugios::where('status', 1)->orderBy('nombre')->get();
        $data = [];
        foreach ($refugios as $refugio) {
            $count = Animales::where('id_refugio', $refugio->id)
                            ->where('status', '!=', 0)
                            ->count();
            $data[] = [
                'name' => $refugio->nombre,
                'y' => $count
            ];
        }
        return view("graficas.grafica_barras")->with('data', $data);
    }

    public function grafica_pie()
    {
        $tipos_animales = Tipos_Animales::where('status', 1)->orderBy('nombre')->get();
        $data = [];
        foreach ($tipos_animales as $tipo) {
            $count = Animales::where('id_tipo_animal', $tipo->id)
                            ->where('status', '!=', 0)
                            ->count();
            if ($count > 0) {
                $data[] = [
                    'name' => $tipo->nombre,
                    'y' => $count
                ];
            }
        }
        return view("graficas.grafica_pie")->with('data', $data);
    }

    public function grafica_3d()
    {
        $estados = [
            ['name' => 'Activo', 'status' => 1],
            ['name' => 'En Proceso', 'status' => 2],
            ['name' => 'Adoptado', 'status' => 3]
        ];
        $data = [];
        foreach ($estados as $estado) {
            $count = Animales::where('status', $estado['status'])->count();
            $data[] = [
                'name' => $estado['name'],
                'y' => $count
            ];
        }
        return view("graficas.grafica_3d")->with('data', $data);
    }
}