<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entidades;
use App\Models\Paises;

class EntidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entidades = Entidades::where('status', 1)
                  ->orderBy('id_pais')
                  ->orderBy('nombre')->get();          
        return view('Entidades.index')->with('entidades', $entidades);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = Paises::select('id','nombre')
                  ->orderBy('nombre')->get();
        return view('Entidades.create')
                ->with('paises',$paises);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        Entidades::create($datos);
        return redirect('/entidades');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entidad = Entidades::find($id);
        return view('Entidades.read')->with('entidad', $entidad);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entidad = Entidades::find($id);
        $paises = Paises::select('id','nombre')
                  ->orderBy('nombre')->get();
        return view('Entidades.edit')
               ->with('entidad', $entidad)
               ->with('paises',$paises);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $entidad = Entidades::find($id);
        $entidad->update($datos);
        return redirect('/entidades');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entidad = Entidades::find($id);
        $entidad->status = 0;
        $entidad->save();
        return redirect('/entidades');
    }
}
