<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animales;
use App\Models\Tipos_Animales;
use App\Models\Refugios;

class AnimalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animales = Animales::where('status', 1)
                    ->orderBy('nombre', 'asc')
                    ->get();

        return view('Animales.index')->with('animales', $animales);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos_animales = Tipos_Animales::select('id', 'nombre')
                          ->where('status', 1)
                          ->orderBy('nombre')
                          ->get();
        $refugios = Refugios::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        return view('Animales.create')
               ->with('tipos_animales', $tipos_animales)
               ->with('refugios', $refugios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        Animales::create($datos);
        return redirect('/animales');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $animal = Animales::find($id);
        return view('Animales.read')->with('animal', $animal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $animal = Animales::find($id);
        $tipos_animales = Tipos_Animales::select('id', 'nombre')
                          ->where('status', 1)
                          ->orderBy('nombre')
                          ->get();
        $refugios = Refugios::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        return view('Animales.edit')
               ->with('animal', $animal)
               ->with('tipos_animales', $tipos_animales)
               ->with('refugios', $refugios);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $animal = Animales::find($id);
        $animal->update($datos);
        return redirect('/animales');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $animal = Animales::find($id);
        $animal->status = 0;
        $animal->save();
        
        return redirect('/animales');
    }
}
