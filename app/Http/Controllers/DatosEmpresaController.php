<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datos_Empresa;
use App\Models\Usuarios;

class DatosEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos_empresa = Datos_Empresa::where('status', 1)
                        ->orderBy('id', 'asc')
                        ->get();

        return view('Datos_Empresa.index')->with('datos_empresa', $datos_empresa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                    ->where('status', 1)
                    ->where('id_rol', 1)
                    ->orderBy('nombre')
                    ->get();
        return view('Datos_Empresa.create')
               ->with('usuarios', $usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        Datos_Empresa::create($datos);
        return redirect('/datos-empresa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dato_empresa = Datos_Empresa::find($id);
        return view('Datos_Empresa.read')->with('dato_empresa', $dato_empresa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dato_empresa = Datos_Empresa::find($id);
        $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        return view('Datos_Empresa.edit')
               ->with('dato_empresa', $dato_empresa)
               ->with('usuarios', $usuarios);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $dato_empresa = Datos_Empresa::find($id);
        $dato_empresa->update($datos);
        return redirect('/datos-empresa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dato_empresa = Datos_Empresa::find($id);
        $dato_empresa->status = 0;
        $dato_empresa->save();
        
        return redirect('/datos-empresa');
    }
}
