<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacunas;
use App\Models\Animales;
use App\Models\Catalogo_Vacunas;

class VacunasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vacunas = Vacunas::where('status', 1)
                   ->orderBy('fecha_aplicacion', 'desc')
                   ->get();

        return view('Vacunas.index')->with('vacunas', $vacunas);
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
        $catalogo_vacunas = Catalogo_Vacunas::select('id', 'nombre')
                            ->where('status', 1)
                            ->orderBy('nombre')
                            ->get();
        return view('Vacunas.create')
               ->with('animales', $animales)
               ->with('catalogo_vacunas', $catalogo_vacunas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        Vacunas::create($datos);
        return redirect('/vacunas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vacuna = Vacunas::find($id);
        return view('Vacunas.read')->with('vacuna', $vacuna);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vacuna = Vacunas::find($id);
        $animales = Animales::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        $catalogo_vacunas = Catalogo_Vacunas::select('id', 'nombre')
                            ->where('status', 1)
                            ->orderBy('nombre')
                            ->get();
        return view('Vacunas.edit')
               ->with('vacuna', $vacuna)
               ->with('animales', $animales)
               ->with('catalogo_vacunas', $catalogo_vacunas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $vacuna = Vacunas::find($id);
        $vacuna->update($datos);
        return redirect('/vacunas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vacuna = Vacunas::find($id);
        $vacuna->status = 0;
        $vacuna->save();
        
        return redirect('/vacunas');
    }
}
