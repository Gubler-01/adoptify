<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Fotos;
use App\Models\Animales;

class FotosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fotos = Fotos::where('status', 1)
                ->orderBy('id_animal')
                ->get();
        return view('Fotos.index')->with('fotos', $fotos);
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
        return view('Fotos.create')
               ->with('animales', $animales);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        $hora = date("h:i:s");
        $fecha = date("d-m-Y");
        $prefijo = $fecha . "_" . $hora;

        $archivo = $request->file('foto');
        $nombre_foto = $prefijo . "_" . $archivo->getClientOriginalName();

        $r1 = Storage::disk('fotografias')->put($nombre_foto, \File::get($archivo));

        if ($r1) {
            $datos['url_foto'] = $nombre_foto;
            $datos['fecha_subida'] = now(); // Asignamos la fecha actual
            Fotos::create($datos);
            return redirect('/fotos');
        } else {
            return 'Error al intentar guardar la foto <br /><br /><a href="../fotos">REGRESAR A LAS FOTOS</a>';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $foto = Fotos::find($id);
        return view('Fotos.read')->with('foto', $foto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $foto = Fotos::find($id);
        $animales = Animales::select('id', 'nombre')
                    ->where('status', 1)
                    ->orderBy('nombre')
                    ->get();
        return view('Fotos.edit')
               ->with('foto', $foto)
               ->with('animales', $animales);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datos = $request->all();
        $foto = Fotos::find($id);

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
            
            $datos['url_foto'] = $nombre_foto;
            $datos['fecha_subida'] = now(); // Actualizamos la fecha de subida
            $foto->update($datos);
            return redirect('/fotos');
        } else {
            return 'Error al intentar guardar la foto <br /><br /><a href="../fotos">REGRESAR A LAS FOTOS</a>';
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $foto = Fotos::find($id);
        $foto->status = 0;
        $foto->save();
        return redirect('/fotos');
    }
}
