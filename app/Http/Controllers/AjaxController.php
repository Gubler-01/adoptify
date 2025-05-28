<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entidades;
use App\Models\Municipios;
use App\Models\Tipos_Animales;
use App\Models\Animales;
use App\Models\Refugios;
use App\Models\Paises;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        if (Auth::user()->id_rol == 2) {
            // Refugio solo ve su propio refugio
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $refugios = Refugios::where('id', $refugio->id)->where('status', 1)->orderBy('nombre')->get();
        } else {
            // Administrador ve todos los refugios
            $refugios = Refugios::where('status', 1)->orderBy('nombre')->get();
        }

        return view('ejemplos_ajax')
            ->with('paises', $paises)
            ->with('tipos_animales', $tipos_animales)
            ->with('refugios', $refugios);
    }

    // Consultar animales por tipo de animal y refugio
    public function buscar_animales_por_tipo($id_tipo_animal, $id_refugio)
    {
        if (Auth::user()->id_rol == 2) {
            // Refugio solo ve animales de su propio refugio
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return '<p>No tienes un refugio asignado.</p>';
            }
            if ($id_refugio != 0 && $id_refugio != $refugio->id) {
                return '<p>No tienes acceso a este refugio.</p>';
            }
            $id_refugio = $refugio->id; // Forzar el refugio del usuario
        }

        $animales = Animales::where('id_tipo_animal', $id_tipo_animal)
            ->where('status', '!=', 0)
            ->when($id_refugio > 0, function ($query) use ($id_refugio) {
                return $query->where('id_refugio', $id_refugio);
            })
            ->orderBy('nombre')
            ->get();

        $tabla = "<table>";
        $tabla .= "<thead><tr><th>Nombre</th><th>Edad</th><th>Raza</th><th>Tipo de Animal</th><th>Refugio</th><th>Status</th><th>Acciones</th></tr></thead><tbody>";

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
            if (Auth::user()->id_rol != 3) { // Solo Administrador y Refugio pueden cambiar status
                $tabla .= "<td><button class='button' onclick='cambiar_status_animal(" . $animal->id . "," . $id_tipo_animal . "," . $id_refugio . ");'>Cambiar Status</button></td>";
            } else {
                $tabla .= "<td></td>";
            }
            $tabla .= "</tr>";
        }

        $tabla .= "</tbody></table>";

        return $tabla;
    }

    // Actualizar el status de un animal
    public function cambiar_status_animal($id_animal, $id_tipo_animal, $id_refugio)
    {
        $animal = Animales::findOrFail($id_animal);

        if (Auth::user()->id_rol == 2) {
            // Refugio solo puede cambiar el status de sus propios animales
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio || $animal->id_refugio != $refugio->id) {
                return '<p>No tienes acceso a este animal.</p>';
            }
        } elseif (Auth::user()->id_rol == 3) {
            // Adoptante no puede cambiar el status
            return '<p>No tienes permisos para cambiar el status.</p>';
        }

        $animal->status = ($animal->status % 3) + 1; // 1 -> 2 -> 3 -> 1
        $animal->save();

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            $id_refugio = $refugio->id; // Forzar el refugio del usuario
        }

        $animales = Animales::where('id_tipo_animal', $id_tipo_animal)
            ->where('status', '!=', 0)
            ->when($id_refugio > 0, function ($query) use ($id_refugio) {
                return $query->where('id_refugio', $id_refugio);
            })
            ->orderBy('nombre')
            ->get();

        $tabla = "<table>";
        $tabla .= "<thead><tr><th>Nombre</th><th>Edad</th><th>Raza</th><th>Tipo de Animal</th><th>Refugio</th><th>Status</th><th>Acciones</th></tr></thead><tbody>";

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
            if (Auth::user()->id_rol != 3) { // Solo Administrador y Refugio pueden cambiar status
                $tabla .= "<td><button class='button' onclick='cambiar_status_animal(" . $animal->id . "," . $id_tipo_animal . "," . $id_refugio . ");'>Cambiar Status</button></td>";
            } else {
                $tabla .= "<td></td>";
            }
            $tabla .= "</tr>";
        }

        $tabla .= "</tbody></table>";

        return $tabla;
    }
}