<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitas;
use App\Models\Solicitudes_Adopciones;

class VisitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitas = Visitas::where('status', 1)
                   ->orderBy('fecha_visita', 'desc')
                   ->get();

        return view('Visitas.index')->with('visitas', $visitas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $solicitudes = Solicitudes_Adopciones::select('id', 'id_animal', 'id_adoptante')
                       ->where('status', 1)
                       ->with(['animales', 'usuarios'])
                       ->get();
        return view('Visitas.create')
               ->with('solicitudes', $solicitudes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        Visitas::create($datos);
        return redirect('/visitas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visita = Visitas::find($id);
        return view('Visitas.read')->with('visita', $visita);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visita = Visitas::find($id);
        $solicitudes = Solicitudes_Adopciones::select('id', 'id_animal', 'id_adoptante')
                       ->where('status', 1)
                       ->with(['animales', 'usuarios'])
                       ->get();
        return view('Visitas.edit')
               ->with('visita', $visita)
               ->with('solicitudes', $solicitudes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $visita = Visitas::find($id);
        $visita->update($datos);
        return redirect('/visitas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visita = Visitas::find($id);
        $visita->status = 0;
        $visita->save();

        return redirect('/visitas');
    }
}
