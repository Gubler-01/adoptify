<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entidades;
use App\Models\Municipios;
use App\Models\Tipos_Animales;
use App\Models\Animales;
use App\Models\Refugios;
use App\Models\Paises;

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

    // Vista principal para los ejemplos AJAX
    public function ejemplos_ajax()
    {
        $paises = Paises::where('status', 1)->orderBy('nombre')->get();
        $tipos_animales = Tipos_Animales::where('status', 1)->orderBy('nombre')->get();
        $refugios = Refugios::where('status', 1)->orderBy('nombre')->get();
        return view('ejemplos_ajax')
            ->with('paises', $paises)
            ->with('tipos_animales', $tipos_animales)
            ->with('refugios', $refugios);
    }

    // Mecanismo 2: Consultar animales por tipo de animal y refugio
    public function buscar_animales_por_tipo($id_tipo_animal, $id_refugio)
    {
        // Si no se selecciona refugio (id_refugio = 0), mostramos todos los animales del tipo seleccionado
        $animales = Animales::where('id_tipo_animal', $id_tipo_animal)
            ->where('status', '!=', 0) // Excluir los que están en "Baja"
            ->when($id_refugio > 0, function ($query) use ($id_refugio) {
                return $query->where('id_refugio', $id_refugio);
            })
            ->orderBy('nombre')
            ->get();

        $tabla = "";
        $tabla .= "<table>";
        $tabla .= "<thead>";
        $tabla .= "<tr>";
        $tabla .= "<th>Nombre</th>";
        $tabla .= "<th>Edad</th>";
        $tabla .= "<th>Raza</th>";
        $tabla .= "<th>Tipo de Animal</th>";
        $tabla .= "<th>Refugio</th>";
        $tabla .= "<th>Status</th>";
        $tabla .= "<th>Acciones</th>";
        $tabla .= "</tr>";
        $tabla .= "</thead>";
        $tabla .= "<tbody>";

        foreach ($animales as $animal) {
            $status_texto = match ($animal->status) {
                1 => 'Activo',
                2 => 'En Proceso',
                3 => 'Adoptado',
                default => 'Desconocido',
            };

            $tabla .= "<tr>";
            $tabla .= "<td>" . $animal->nombre . "</td>";
            $tabla .= "<td>" . $animal->edad . "</td>";
            $tabla .= "<td>" . $animal->raza . "</td>";
            $tabla .= "<td>" . $animal->tipos_animales->nombre . "</td>";
            $tabla .= "<td>" . $animal->refugios->nombre . "</td>";
            $tabla .= "<td>" . $status_texto . "</td>";
            $tabla .= "<td><button class='button' onclick='cambiar_status_animal(" . $animal->id . "," . $id_tipo_animal . "," . $id_refugio . ");'>";
            $tabla .= "Cambiar Status</button></td>";
            $tabla .= "</tr>";
        }

        $tabla .= "</tbody>";
        $tabla .= "</table>";

        return $tabla;
    }

    // Mecanismo 3: Actualizar el status de un animal
    public function cambiar_status_animal($id_animal, $id_tipo_animal, $id_refugio)
    {
        $animal = Animales::find($id_animal);
        // Ciclar entre los estados: 1 (Activo) -> 2 (En Proceso) -> 3 (Adoptado) -> 1 (Activo)
        $animal->status = ($animal->status % 3) + 1; // 1 -> 2 -> 3 -> 1
        $animal->save();

        $animales = Animales::where('id_tipo_animal', $id_tipo_animal)
            ->where('status', '!=', 0)
            ->when($id_refugio > 0, function ($query) use ($id_refugio) {
                return $query->where('id_refugio', $id_refugio);
            })
            ->orderBy('nombre')
            ->get();

        $tabla = "";
        $tabla .= "<table>";
        $tabla .= "<thead>";
        $tabla .= "<tr>";
        $tabla .= "<th>Nombre</th>";
        $tabla .= "<th>Edad</th>";
        $tabla .= "<th>Raza</th>";
        $tabla .= "<th>Tipo de Animal</th>";
        $tabla .= "<th>Refugio</th>";
        $tabla .= "<th>Status</th>";
        $tabla .= "<th>Acciones</th>";
        $tabla .= "</tr>";
        $tabla .= "</thead>";
        $tabla .= "<tbody>";

        foreach ($animales as $animal) {
            $status_texto = match ($animal->status) {
                1 => 'Activo',
                2 => 'En Proceso',
                3 => 'Adoptado',
                default => 'Desconocido',
            };

            $tabla .= "<tr>";
            $tabla .= "<td>" . $animal->nombre . "</td>";
            $tabla .= "<td>" . $animal->edad . "</td>";
            $tabla .= "<td>" . $animal->raza . "</td>";
            $tabla .= "<td>" . $animal->tipos_animales->nombre . "</td>";
            $tabla .= "<td>" . $animal->refugios->nombre . "</td>";
            $tabla .= "<td>" . $status_texto . "</td>";
            $tabla .= "<td><button class='button' onclick='cambiar_status_animal(" . $animal->id . "," . $id_tipo_animal . "," . $id_refugio . ");'>";
            $tabla .= "Cambiar Status</button></td>";
            $tabla .= "</tr>";
        }

        $tabla .= "</tbody>";
        $tabla .= "</table>";

        return $tabla;
    }
}