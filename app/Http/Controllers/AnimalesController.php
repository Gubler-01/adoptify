<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animales;
use App\Models\Tipos_Animales;
use App\Models\Refugios;
use Illuminate\Support\Facades\Auth;

class AnimalesController extends Controller
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
        if (Auth::user()->id_rol == 1) {
            // Administrador ve todos los animales activos
            $animales = Animales::where('status', 1)
                        ->orderBy('nombre', 'asc')
                        ->get();
        } elseif (Auth::user()->id_rol == 2) {
            // Refugio ve solo los animales de su refugio
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $animales = Animales::where('id_refugio', $refugio->id)
                        ->where('status', 1)
                        ->orderBy('nombre', 'asc')
                        ->get();
        } else {
            // Adoptante ve todos los animales activos
            $animales = Animales::where('status', 1)
                        ->orderBy('nombre', 'asc')
                        ->get();
        }

        return view('Animales.index')->with('animales', $animales);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/animales')->with('error', 'No tienes permisos para crear animales.');
        }

        $tipos_animales = Tipos_Animales::select('id', 'nombre')
                          ->where('status', 1)
                          ->orderBy('nombre')
                          ->get();
        $refugios = Refugios::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();

        if (Auth::user()->id_rol == 2) {
            // Refugio solo puede crear animales para su propio refugio
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $refugios = Refugios::select('id', 'nombre')
                        ->where('id', $refugio->id)
                        ->get();
        }

        return view('Animales.create')
               ->with('tipos_animales', $tipos_animales)
               ->with('refugios', $refugios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/animales')->with('error', 'No tienes permisos para crear animales.');
        }

        $datos = $request->all();
        if (Auth::user()->id_rol == 2) {
            // Validar que el refugio seleccionado sea el del usuario autenticado
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio || $datos['id_refugio'] != $refugio->id) {
                return redirect('/animales')->with('error', 'No puedes crear animales para otro refugio.');
            }
        }

        Animales::create($datos);
        return redirect('/animales')->with('success', 'Animal creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $animal = Animales::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio || $animal->id_refugio != $refugio->id) {
                return redirect('/animales')->with('error', 'No tienes acceso a este animal.');
            }
        }

        return view('Animales.read')->with('animal', $animal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/animales')->with('error', 'No tienes permisos para editar animales.');
        }

        $animal = Animales::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio || $animal->id_refugio != $refugio->id) {
                return redirect('/animales')->with('error', 'No tienes acceso a este animal.');
            }
        }

        $tipos_animales = Tipos_Animales::select('id', 'nombre')
                          ->where('status', 1)
                          ->orderBy('nombre')
                          ->get();
        $refugios = Refugios::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            $refugios = Refugios::select('id', 'nombre')
                        ->where('id', $refugio->id)
                        ->get();
        }

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
        if (Auth::user()->id_rol == 3) {
            return redirect('/animales')->with('error', 'No tienes permisos para editar animales.');
        }

        $animal = Animales::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio || $animal->id_refugio != $refugio->id) {
                return redirect('/animales')->with('error', 'No tienes acceso a este animal.');
            }
            // Validar que el refugio no cambie a otro
            $datos = $request->all();
            if ($datos['id_refugio'] != $refugio->id) {
                return redirect('/animales')->with('error', 'No puedes cambiar el refugio de este animal.');
            }
        }

        $animal->update($request->all());
        return redirect('/animales')->with('success', 'Animal actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/animales')->with('error', 'No tienes permisos para eliminar animales.');
        }

        $animal = Animales::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio || $animal->id_refugio != $refugio->id) {
                return redirect('/animales')->with('error', 'No tienes acceso a este animal.');
            }
        }

        $animal->status = 0;
        $animal->save();

        return redirect('/animales')->with('success', 'Animal eliminado exitosamente.');
    }
}