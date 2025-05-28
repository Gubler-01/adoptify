<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Fotos;
use App\Models\Animales;
use App\Models\Refugios;
use Illuminate\Support\Facades\Auth;

class FotosController extends Controller
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
            // Administrador ve todas las fotos activas
            $fotos = Fotos::where('status', 1)
                    ->orderBy('id_animal')
                    ->get();
        } elseif (Auth::user()->id_rol == 2) {
            // Refugio ve solo las fotos de los animales de su refugio
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $animalesIds = Animales::where('id_refugio', $refugio->id)
                          ->pluck('id');
            $fotos = Fotos::whereIn('id_animal', $animalesIds)
                    ->where('status', 1)
                    ->orderBy('id_animal')
                    ->get();
        } else {
            // Adoptante puede ver todas las fotos activas (si es necesario)
            $fotos = Fotos::where('status', 1)
                    ->orderBy('id_animal')
                    ->get();
        }

        return view('Fotos.index')->with('fotos', $fotos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/fotos')->with('error', 'No tienes permisos para crear fotos.');
        }

        if (Auth::user()->id_rol == 1) {
            // Administrador ve todos los animales activos
            $animales = Animales::select('id', 'nombre')
                        ->where('status', 1)
                        ->orderBy('nombre')
                        ->get();
        } else {
            // Refugio ve solo sus animales
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $animales = Animales::select('id', 'nombre')
                        ->where('id_refugio', $refugio->id)
                        ->where('status', 1)
                        ->orderBy('nombre')
                        ->get();
        }

        return view('Fotos.create')
               ->with('animales', $animales);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/fotos')->with('error', 'No tienes permisos para crear fotos.');
        }

        $datos = $request->all();
        $hora = date("h:i:s");
        $fecha = date("d-m-Y");
        $prefijo = $fecha . "_" . $hora;

        if (Auth::user()->id_rol == 2) {
            // Validar que el animal pertenece al refugio del usuario
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $animal = Animales::find($datos['id_animal']);
            if (!$animal || $animal->id_refugio != $refugio->id) {
                return redirect('/fotos')->with('error', 'No puedes subir fotos para este animal.');
            }
        }

        $archivo = $request->file('foto');
        $nombre_foto = $prefijo . "_" . $archivo->getClientOriginalName();

        $r1 = Storage::disk('fotografias')->put($nombre_foto, \File::get($archivo));

        if ($r1) {
            $datos['url_foto'] = $nombre_foto;
            $datos['fecha_subida'] = now();
            Fotos::create($datos);
            return redirect('/fotos')->with('success', 'Foto creada exitosamente.');
        } else {
            return redirect('/fotos')->with('error', 'Error al intentar guardar la foto.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $foto = Fotos::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $animal = Animales::find($foto->id_animal);
            if (!$animal || $animal->id_refugio != $refugio->id) {
                return redirect('/fotos')->with('error', 'No tienes acceso a esta foto.');
            }
        }

        return view('Fotos.read')->with('foto', $foto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/fotos')->with('error', 'No tienes permisos para editar fotos.');
        }

        $foto = Fotos::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $animal = Animales::find($foto->id_animal);
            if (!$animal || $animal->id_refugio != $refugio->id) {
                return redirect('/fotos')->with('error', 'No tienes acceso a esta foto.');
            }
        }

        if (Auth::user()->id_rol == 1) {
            $animales = Animales::select('id', 'nombre')
                        ->where('status', 1)
                        ->orderBy('nombre')
                        ->get();
        } else {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            $animales = Animales::select('id', 'nombre')
                        ->where('id_refugio', $refugio->id)
                        ->where('status', 1)
                        ->orderBy('nombre')
                        ->get();
        }

        return view('Fotos.edit')
               ->with('foto', $foto)
               ->with('animales', $animales);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/fotos')->with('error', 'No tienes permisos para editar fotos.');
        }

        $foto = Fotos::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $animal = Animales::find($foto->id_animal);
            if (!$animal || $animal->id_refugio != $refugio->id) {
                return redirect('/fotos')->with('error', 'No tienes acceso a esta foto.');
            }
            // Validar que el animal seleccionado sigue siendo de su refugio
            $datos = $request->all();
            $nuevoAnimal = Animales::find($datos['id_animal']);
            if (!$nuevoAnimal || $nuevoAnimal->id_refugio != $refugio->id) {
                return redirect('/fotos')->with('error', 'No puedes cambiar la foto a un animal de otro refugio.');
            }
        }

        $hora = date("h:i:s");
        $fecha = date("d-m-Y");
        $prefijo = $fecha . "_" . $hora;

        $archivo = $request->file('foto');
        $nombre_foto = $prefijo . "_" . $archivo->getClientOriginalName();

        $r1 = Storage::disk('fotografias')->put($nombre_foto, \File::get($archivo));

        if ($r1) {
            // Eliminar la foto anterior si existe
            if ($foto->url_foto && Storage::disk('fotografias')->exists($foto->url_foto)) {
                Storage::disk('fotografias')->delete($foto->url_foto);
            }

            $datos = $request->all();
            $datos['url_foto'] = $nombre_foto;
            $datos['fecha_subida'] = now();
            $foto->update($datos);
            return redirect('/fotos')->with('success', 'Foto actualizada exitosamente.');
        } else {
            return redirect('/fotos')->with('error', 'Error al intentar guardar la foto.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/fotos')->with('error', 'No tienes permisos para eliminar fotos.');
        }

        $foto = Fotos::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Refugios::where('id_usuario', Auth::user()->id)->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $animal = Animales::find($foto->id_animal);
            if (!$animal || $animal->id_refugio != $refugio->id) {
                return redirect('/fotos')->with('error', 'No tienes acceso a esta foto.');
            }
        }

        $foto->status = 0;
        $foto->save();
        return redirect('/fotos')->with('success', 'Foto eliminada exitosamente.');
    }
}