<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refugios;
use App\Models\Paises;
use App\Models\Usuarios;

class RefugiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $refugios = Refugios::where('status', 1)
                    ->orderBy('nombre', 'desc')
                    ->get();

        return view('Refugios.index')->with('refugios', $refugios);
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
        $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                    ->where('status', 1)
                    ->where('id_rol', 2)
                    ->orderBy('nombre')
                    ->get();
        return view('Refugios.create')
               ->with('paises', $paises)
               ->with('usuarios', $usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'calle' => 'required|string|max:100',
            'numero_exterior' => 'required|string|max:10',
            'numero_interior' => 'nullable|string|max:10',
            'codigo_postal' => 'required|string|max:10',
            'colonia' => 'required|string|max:100',
            'id_usuario' => 'required|exists:usuarios,id',
            'municipio_id' => 'required|exists:municipios,id',
            'status' => 'required|in:0,1',
        ]);

        $datos = $request->all();
        // Mapear municipio_id a id_municipio
        $datos['id_municipio'] = $datos['municipio_id'];
        unset($datos['municipio_id']); // Eliminar municipio_id para evitar conflictos
        $datos['id_pais'] = $datos['id_pais'] ?? null;
        $datos['id_entidad'] = $datos['id_entidad'] ?? null;
        unset($datos['id_pais']);
        unset($datos['id_entidad']);

        Refugios::create($datos);

        return redirect('/refugios')->with('success', 'Refugio creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $refugio = Refugios::find($id);
        return view('Refugios.read')->with('refugio', $refugio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $refugio = Refugios::find($id);
        $paises = Paises::select('id', 'nombre')
                  ->where('status', 1)
                  ->orderBy('nombre')
                  ->get();
        $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        return view('Refugios.edit')
               ->with('refugio', $refugio)
               ->with('paises', $paises)
               ->with('usuarios', $usuarios);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'calle' => 'required|string|max:100',
            'numero_exterior' => 'required|string|max:10',
            'numero_interior' => 'nullable|string|max:10',
            'codigo_postal' => 'required|string|max:10',
            'colonia' => 'required|string|max:100',
            'id_usuario' => 'required|exists:usuarios,id',
            'municipio_id' => 'required|exists:municipios,id',
            'status' => 'required|in:0,1',
        ]);

        $datos = $request->all();
        // Mapear municipio_id a id_municipio
        $datos['id_municipio'] = $datos['municipio_id'];
        unset($datos['municipio_id']);
        $datos['id_pais'] = $datos['id_pais'] ?? null;
        $datos['id_entidad'] = $datos['id_entidad'] ?? null;
        unset($datos['id_pais']);
        unset($datos['id_entidad']);

        $refugio = Refugios::find($id);
        $refugio->update($datos);

        return redirect('/refugios')->with('success', 'Refugio actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $refugio = Refugios::find($id);
        $refugio->status = 0;
        $refugio->save();
        
        return redirect('/refugios')->with('success', 'Refugio eliminado exitosamente');
    }
}