<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entidades;
use App\Models\Municipios;

class AjaxController extends Controller
{
    public function cambia_combo($id_pais)
    {
        $entidades = Entidades::select('id', 'nombre')
                    ->where('id_pais', $id_pais)
                    ->orderBy('nombre')
                    ->get();

        return $entidades;
    }

    public function cambia_combo_2($id_entidad)
    {
        $municipios = Municipios::select('id', 'nombre')
                    ->where('id_entidad', $id_entidad)
                    ->orderBy('nombre')
                    ->get();

        return $municipios;
    }
}
