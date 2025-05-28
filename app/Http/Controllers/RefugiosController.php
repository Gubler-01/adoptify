<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refugios;
use App\Models\Paises;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Auth;

class RefugiosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->id_rol == 2) {
            // Refugio solo ve su propio registro
            $refugios = Refugios::where('id_usuario', Auth::user()->id)
                        ->where('status', 1)
                        ->orderBy('nombre', 'desc')
                        ->get();
        } else {
            // Administrador ve todos
            $refugios = Refugios::where('status', 1)
                        ->orderBy('nombre', 'desc')
                        ->get();
        }

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

        if (Auth::user()->id_rol == 2) {
            // Refugio solo puede crear su propio registro
            $refugioExistente = Refugios::where('id_usuario', Auth::user()->id)->first();
            if ($refugioExistente) {
                return redirect('/refugios')->with('error', 'Ya tienes un refugio registrado.');
            }
            $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                        ->where('id', Auth::user()->id)
                        ->get();
        }

        return view('Refugios.create')
               ->with('paises', $paises)
               ->with('usuarios', $usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        if (Auth::user()->id_rol == 2) {
            // Refugio solo puede crear su propio registro
            if ($datos['id_usuario'] != Auth::user()->id) {
                return redirect('/refugios')->with('error', 'No puedes crear un refugio para otro usuario.');
            }
            $refugioExistente = Refugios::where('id_usuario', Auth::user()->id)->first();
            if ($refugioExistente) {
                return redirect('/refugios')->with('error', 'Ya tienes un refugio registrado.');
            }
        }

        $datos['id_municipio'] = $datos['municipio_id'];
        unset($datos['municipio_id']);
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
        $refugio = Refugios::findOrFail($id);

        if (Auth::user()->id_rol == 2 && $refugio->id_usuario != Auth::user()->id) {
            return redirect('/refugios')->with('error', 'No tienes acceso a este refugio.');
        }

        return view('Refugios.read')->with('refugio', $refugio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $refugio = Refugios::findOrFail($id);

        if (Auth::user()->id_rol == 2 && $refugio->id_usuario != Auth::user()->id) {
            return redirect('/refugios')->with('error', 'No tienes acceso a este refugio.');
        }

        $paises = Paises::select('id', 'nombre')
                  ->where('status', 1)
                  ->orderBy('nombre')
                  ->get();
        $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();

        if (Auth::user()->id_rol == 2) {
            $usuarios = Usuarios::select('id', 'nombre', 'ap_pat', 'ap_mat')
                        ->where('id', Auth::user()->id)
                        ->get();
        }

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

        $refugio = Refugios::findOrFail($id);

        if (Auth::user()->id_rol == 2 && $refugio->id_usuario != Auth::user()->id) {
            return redirect('/refugios')->with('error', 'No tienes acceso a este refugio.');
        }

        $datos = $request->all();
        if (Auth::user()->id_rol == 2 && $datos['id_usuario'] != Auth::user()->id) {
            return redirect('/refugios')->with('error', 'No puedes cambiar el usuario de este refugio.');
        }

        $datos['id_municipio'] = $datos['municipio_id'];
        unset($datos['municipio_id']);
        $datos['id_pais'] = $datos['id_pais'] ?? null;
        $datos['id_entidad'] = $datos['id_entidad'] ?? null;
        unset($datos['id_pais']);
        unset($datos['id_entidad']);

        $refugio->update($datos);

        return redirect('/refugios')->with('success', 'Refugio actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $refugio = Refugios::findOrFail($id);

        if (Auth::user()->id_rol == 2 && $refugio->id_usuario != Auth::user()->id) {
            return redirect('/refugios')->with('error', 'No tienes acceso a este refugio.');
        }

        $refugio->status = 0;
        $refugio->save();

        return redirect('/refugios')->with('success', 'Refugio eliminado exitosamente');
    }
}