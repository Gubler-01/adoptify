<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes_Adopciones;
use App\Models\Animales;
use App\Models\Usuarios;
use Carbon\Carbon;

class SolicitudesAdopcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitudes = Solicitudes_Adopciones::where('status', 1)
                       ->orderBy('fecha_solicitud', 'desc')
                       ->get();

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

        Solicitudes_Adopciones::create($datos);
        return redirect('/solicitudes-adopcion')->with('success', 'Solicitud creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $solicitud = Solicitudes_Adopciones::findOrFail($id);
        return view('Solicitudes_Adopciones.read')->with('solicitud', $solicitud);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $solicitud = Solicitudes_Adopciones::findOrFail($id);
        $animales = Animales::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                    ->where('status', 1)
                    ->where('id_rol', 3) // Filtramos usuarios con rol de adoptante
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
        $solicitud->update($datos);
        return redirect('/solicitudes-adopcion')->with('success', 'Solicitud actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $solicitud = Solicitudes_Adopciones::findOrFail($id);
        $solicitud->status = 0;
        $solicitud->save();
        
        return redirect('/solicitudes-adopcion')->with('success', 'Solicitud eliminada exitosamente');
    }
}
