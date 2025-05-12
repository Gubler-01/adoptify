<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipios;
use App\Models\Entidades;
use App\Models\Paises;

class MunicipiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $municipios = Municipios::where('status', 1)
                    ->orderBy('nombre', 'asc')
                    ->get();

        return view('Municipios.index')->with('municipios', $municipios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = Paises::select('id', 'nombre')
                  ->where('status', 1)
                  ->orderBy('nombre')
                  ->get();
        $entidades = Entidades::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        return view('Municipios.create')
               ->with('paises', $paises)
               ->with('entidades', $entidades);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'id_entidad' => 'required|exists:entidades,id',
            'status' => 'required|in:0,1',
        ]);

        $datos = $request->all();
        Municipios::create($datos);

        return redirect('/municipios')->with('success', 'Municipio creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $municipio = Municipios::find($id);
        return view('Municipios.read')->with('municipio', $municipio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $municipio = Municipios::find($id);
        $paises = Paises::select('id', 'nombre')
                  ->where('status', 1)
                  ->orderBy('nombre')
                  ->get();
        $entidades = Entidades::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        return view('Municipios.edit')
               ->with('municipio', $municipio)
               ->with('paises', $paises)
               ->with('entidades', $entidades);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'id_entidad' => 'required|exists:entidades,id',
            'status' => 'required|in:0,1',
        ]);

        $datos = $request->all();
        $municipio = Municipios::find($id);
        $municipio->update($datos);

        return redirect('/municipios')->with('success', 'Municipio actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $municipio = Municipios::find($id);
        $municipio->status = 0;
        $municipio->save();
        
        return redirect('/municipios')->with('success', 'Municipio eliminado exitosamente');
    }
}