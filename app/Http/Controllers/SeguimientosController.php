<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguimientos;
use App\Models\Adopciones;
use App\Models\Solicitudes_Adopcion;

class SeguimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seguimientos = Seguimientos::where('status', 1)
                        ->orderBy('fecha_seguimiento', 'desc')
                        ->get();

        return view('Seguimientos.index')->with('seguimientos', $seguimientos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adopciones = Adopciones::select('id', 'id_solicitud')
                      ->where('status', 1)
                      ->with(['solicitudes_adopcion.animales', 'solicitudes_adopcion.usuarios'])
                      ->get();
        return view('Seguimientos.create')
               ->with('adopciones', $adopciones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        Seguimientos::create($datos);
        return redirect('/seguimientos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seguimiento = Seguimientos::find($id);
        return view('Seguimientos.read')->with('seguimiento', $seguimiento);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $seguimiento = Seguimientos::find($id);
        $adopciones = Adopciones::select('id', 'id_solicitud')
                      ->where('status', 1)
                      ->with(['solicitudes_adopcion.animales', 'solicitudes_adopcion.usuarios'])
                      ->get();
        return view('Seguimientos.edit')
               ->with('seguimiento', $seguimiento)
               ->with('adopciones', $adopciones);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $seguimiento = Seguimientos::find($id);
        $seguimiento->update($datos);
        return redirect('/seguimientos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seguimiento = Seguimientos::find($id);
        $seguimiento->status = 0;
        $seguimiento->save();
        
        return redirect('/seguimientos');
    }
}
