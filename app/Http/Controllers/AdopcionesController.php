<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adopciones;
use App\Models\Solicitudes_Adopciones;

class AdopcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adopciones = Adopciones::where('status', 1)
                      ->orderBy('fecha_adopcion', 'desc')
                      ->get();

        return view('Adopciones.index')->with('adopciones', $adopciones);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $solicitudes = Solicitudes_Adopciones::select('id', 'id_animal', 'id_adoptante')
                       ->where('status', 1)
                       ->where('estado', 'Aprobada') // Cambiado de status_adopcion a estado
                       ->with(['animales', 'usuarios'])
                       ->get();
        return view('Adopciones.create')
               ->with('solicitudes', $solicitudes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        Adopciones::create($datos);
        return redirect('/adopciones');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $adopcion = Adopciones::find($id);
        return view('Adopciones.read')->with('adopcion', $adopcion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adopcion = Adopciones::find($id);
        $solicitudes = Solicitudes_Adopciones::select('id', 'id_animal', 'id_adoptante')
                       ->where('status', 1)
                       ->where('estado', 'Aprobada') // Cambiado de status_adopcion a estado
                       ->with(['animales', 'usuarios'])
                       ->get();
        return view('Adopciones.edit')
               ->with('adopcion', $adopcion)
               ->with('solicitudes', $solicitudes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $adopcion = Adopciones::find($id);
        $adopcion->update($datos);
        return redirect('/adopciones');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adopcion = Adopciones::find($id);
        $adopcion->status = 0;
        $adopcion->save();
        
        return redirect('/adopciones');
    }
}
