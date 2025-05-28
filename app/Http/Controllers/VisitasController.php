<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitas;
use App\Models\Solicitudes_Adopciones;
use Illuminate\Support\Facades\Auth;

class VisitasController extends Controller
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
            // Administrador ve todas las visitas activas
            $visitas = Visitas::where('status', 1)
                      ->orderBy('fecha_visita', 'desc')
                      ->get();
        } elseif (Auth::user()->id_rol == 2) {
            // Refugio ve las visitas asociadas a su refugio
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio) {
                return redirect('/home')->with('error', 'No tienes un refugio asignado.');
            }
            $visitas = Visitas::where('status', 1)
                      ->whereHas('solicitudes_adopcion', function ($query) use ($refugio) {
                          $query->whereHas('animales', function ($query) use ($refugio) {
                              $query->where('id_refugio', $refugio->id);
                          });
                      })
                      ->orderBy('fecha_visita', 'desc')
                      ->get();
        } else {
            // Adoptante ve solo sus propias visitas a través de la solicitud
            $visitas = Visitas::where('status', 1)
                      ->whereHas('solicitudes_adopcion', function ($query) {
                          $query->where('id_adoptante', Auth::user()->id);
                      })
                      ->orderBy('fecha_visita', 'desc')
                      ->get();
        }

        return view('Visitas.index')->with('visitas', $visitas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->id_rol == 3) {
            // Adoptante solo ve sus propias solicitudes
            $solicitudes = Solicitudes_Adopciones::where('status', 1)
                           ->where('id_adoptante', Auth::user()->id)
                           ->with(['animales', 'usuarios'])
                           ->get();
        } else {
            // Administrador y Refugio ven todas las solicitudes activas
            $solicitudes = Solicitudes_Adopciones::where('status', 1)
                           ->with(['animales', 'usuarios'])
                           ->get();
        }

        return view('Visitas.create')
               ->with('solicitudes', $solicitudes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_solicitud' => 'required|exists:solicitudes_adopciones,id',
            'fecha_visita' => 'required|date',
            'comentarios' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        $datos = $request->all();
        if (Auth::user()->id_rol == 3) {
            $solicitud = Solicitudes_Adopciones::findOrFail($datos['id_solicitud']);
            if ($solicitud->id_adoptante != Auth::user()->id) {
                return redirect('/visitas')->with('error', 'No puedes crear una visita para una solicitud que no te pertenece.');
            }
        }

        Visitas::create($datos);
        return redirect('/visitas')->with('success', 'Visita creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visita = Visitas::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio) {
                return redirect('/visitas')->with('error', 'No tienes un refugio asignado.');
            }
            $solicitud = $visita->solicitudes_adopcion;
            if ($solicitud->animales->id_refugio != $refugio->id) {
                return redirect('/visitas')->with('error', 'No tienes acceso a esta visita.');
            }
        } elseif (Auth::user()->id_rol == 3) {
            $solicitud = $visita->solicitudes_adopcion;
            if ($solicitud->id_adoptante != Auth::user()->id) {
                return redirect('/visitas')->with('error', 'No tienes acceso a esta visita.');
            }
        }

        return view('Visitas.read')->with('visita', $visita);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/visitas')->with('error', 'No tienes permisos para editar visitas.');
        }

        $visita = Visitas::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio) {
                return redirect('/visitas')->with('error', 'No tienes un refugio asignado.');
            }
            $solicitud = $visita->solicitudes_adopcion;
            if ($solicitud->animales->id_refugio != $refugio->id) {
                return redirect('/visitas')->with('error', 'No tienes acceso a esta visita.');
            }
        }

        $solicitudes = Solicitudes_Adopciones::where('status', 1)
                       ->with(['animales', 'usuarios'])
                       ->get();
        return view('Visitas.edit')
               ->with('visita', $visita)
               ->with('solicitudes', $solicitudes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/visitas')->with('error', 'No tienes permisos para editar visitas.');
        }

        $request->validate([
            'id_solicitud' => 'required|exists:solicitudes_adopciones,id',
            'fecha_visita' => 'required|date',
            'comentarios' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        $datos = $request->all();
        $visita = Visitas::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio) {
                return redirect('/visitas')->with('error', 'No tienes un refugio asignado.');
            }
            $solicitud = $visita->solicitudes_adopcion;
            if ($solicitud->animales->id_refugio != $refugio->id) {
                return redirect('/visitas')->with('error', 'No tienes acceso a esta visita.');
            }
        }

        $visita->update($datos);
        return redirect('/visitas')->with('success', 'Visita actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->id_rol == 3) {
            return redirect('/visitas')->with('error', 'No tienes permisos para eliminar visitas.');
        }

        $visita = Visitas::findOrFail($id);

        if (Auth::user()->id_rol == 2) {
            $refugio = Auth::user()->refugio()->first();
            if (!$refugio) {
                return redirect('/visitas')->with('error', 'No tienes un refugio asignado.');
            }
            $solicitud = $visita->solicitudes_adopcion;
            if ($solicitud->animales->id_refugio != $refugio->id) {
                return redirect('/visitas')->with('error', 'No tienes acceso a esta visita.');
            }
        }

        $visita->status = 0;
        $visita->save();

        return redirect('/visitas')->with('success', 'Visita eliminada exitosamente');
    }
}