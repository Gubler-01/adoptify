<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes_Adopciones;
use App\Models\Animales;
use App\Models\Usuarios;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SolicitudesAdopcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->id_rol == 1) {
            // Administrador ve todas las solicitudes activas
            $solicitudes = Solicitudes_Adopciones::where('status', 1)
                           ->orderBy('fecha_solicitud', 'desc')
                           ->get();
        } elseif (Auth::user()->id_rol == 2) {
            // Refugio ve las solicitudes asociadas a su refugio
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $solicitudes = Solicitudes_Adopciones::where('status', 1)
                           ->whereHas('animal', function ($query) use ($refugio) {
                               $query->where('id_refugio', $refugio->id);
                           })
                           ->orderBy('fecha_solicitud', 'desc')
                           ->get();
        } else {
            // Adoptante ve solo sus propias solicitudes
            $solicitudes = Solicitudes_Adopciones::where('status', 1)
                           ->where('id_adoptante', Auth::user()->id)
                           ->orderBy('fecha_solicitud', 'desc')
                           ->get();
        }

        return view('Solicitudes_Adopciones.index')->with('solicitudes', $solicitudes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $animales = Animales::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();

        if (Auth::user()->id_rol == 3) {
            // Adoptante solo ve animales disponibles
            return view('Solicitudes_Adopciones.create')
                   ->with('animales', $animales)
                   ->with('usuarios', collect([Auth::user()]));
        }

        $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                    ->where('status', 1)
                    ->where('id_rol', 3) // Filtramos usuarios con rol de adoptante
                    ->orderBy('nombre')
                    ->get();
        return view('Solicitudes_Adopciones.create')
               ->with('animales', $animales)
               ->with('usuarios', $usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_animal' => 'required|exists:animales,id',
            'fecha_solicitud' => 'required|date',
            'hora_solicitud' => 'required|in:' . implode(',', array_map(function($i) { return str_pad($i, 2, '0', STR_PAD_LEFT); }, range(0, 23))),
            'minuto_solicitud' => 'required|in:00,15,30,45',
            'estado' => 'required|in:Pendiente,Aprobada,Rechazada',
            'status' => 'required|in:0,1',
        ]);

        $fecha = $request->input('fecha_solicitud');
        $hora = $request->input('hora_solicitud');
        $minuto = $request->input('minuto_solicitud');
        $fechaCompleta = Carbon::createFromFormat('Y-m-d H:i', "$fecha $hora:$minuto");

        $datos = $request->all();
        $datos['fecha_solicitud'] = $fechaCompleta;
        $datos['id_adoptante'] = Auth::user()->id; // Establece automáticamente el adoptante autenticado

        Solicitudes_Adopciones::create($datos);
        return redirect('/solicitudes-adopcion')->with('success', 'Solicitud creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $solicitud = Solicitudes_Adopciones::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio || $solicitud->animal->id_refugio != $refugio->id) {
                return redirect('/solicitudes-adopcion')->with('error', 'No tienes acceso a esta solicitud.');
            }
        } elseif (Auth::user()->id_rol == 3) {
            if ($solicitud->id_adoptante != Auth::user()->id) {
                return redirect('/solicitudes-adopcion')->with('error', 'No tienes acceso a esta solicitud.');
            }
        }

        return view('Solicitudes_Adopciones.read')->with('solicitud', $solicitud);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/solicitudes-adopcion')->with('error', 'No tienes permisos para editar solicitudes.');
        }

        $solicitud = Solicitudes_Adopciones::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio || $solicitud->animal->id_refugio != $refugio->id) {
                return redirect('/solicitudes-adopcion')->with('error', 'No tienes acceso a esta solicitud.');
            }
        }

        $animales = Animales::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                    ->where('status', 1)
                    ->where('id_rol', 3)
                    ->orderBy('nombre')
                    ->get();
        return view('Solicitudes_Adopciones.edit')
               ->with('solicitud', $solicitud)
               ->with('animales', $animales)
               ->with('usuarios', $usuarios);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/solicitudes-adopcion')->with('error', 'No tienes permisos para editar solicitudes.');
        }

        $request->validate([
            'id_animal' => 'required|exists:animales,id',
            'id_adoptante' => 'required|exists:usuarios,id',
            'fecha_solicitud' => 'required|date',
            'hora_solicitud' => 'required|in:' . implode(',', array_map(function($i) { return str_pad($i, 2, '0', STR_PAD_LEFT); }, range(0, 23))),
            'minuto_solicitud' => 'required|in:00,15,30,45',
            'estado' => 'required|in:Pendiente,Aprobada,Rechazada',
            'status' => 'required|in:0,1',
        ]);

        $fecha = $request->input('fecha_solicitud');
        $hora = $request->input('hora_solicitud');
        $minuto = $request->input('minuto_solicitud');
        $fechaCompleta = Carbon::createFromFormat('Y-m-d H:i', "$fecha $hora:$minuto");

        $datos = $request->all();
        $datos['fecha_solicitud'] = $fechaCompleta;

        $solicitud = Solicitudes_Adopciones::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio || $solicitud->animal->id_refugio != $refugio->id) {
                return redirect('/solicitudes-adopcion')->with('error', 'No tienes acceso a esta solicitud.');
            }
        }

        $solicitud->update($datos);
        return redirect('/solicitudes-adopcion')->with('success', 'Solicitud actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/solicitudes-adopcion')->with('error', 'No tienes permisos para eliminar solicitudes.');
        }

        $solicitud = Solicitudes_Adopciones::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio || $solicitud->animal->id_refugio != $refugio->id) {
                return redirect('/solicitudes-adopcion')->with('error', 'No tienes acceso a esta solicitud.');
            }
        }

        $solicitud->status = 0;
        $solicitud->save();

        return redirect('/solicitudes-adopcion')->with('success', 'Solicitud eliminada exitosamente');
    }
}