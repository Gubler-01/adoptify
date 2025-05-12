<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\Paises;
use App\Models\Entidades;
use App\Models\Municipios;
use App\Models\Roles_Usuarios;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuarios::where('status', 1)
                    ->orderBy('nombre', 'asc')
                    ->get();

        return view('Usuarios.index')->with('users', $usuarios);
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
        $tipos_usuario = Roles_Usuarios::select('id', 'nombre')
                        ->where('status', 1)
                        ->orderBy('nombre')
                        ->get();
        return view('Usuarios.create')
               ->with('paises', $paises)
               ->with('tipos_usuario', $tipos_usuario);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'ap_pat' => 'required|string|max:50',
            'ap_mat' => 'nullable|string|max:50',
            'username' => 'required|string|max:50|unique:usuarios,username',
            'password' => 'required|string|max:255|min:8',
            'email' => 'required|email|max:100|unique:usuarios,email',
            'telefono' => 'nullable|string|max:15',
            'genero' => 'nullable|string|max:20|in:M,F,O',
            'fecha_nacimiento' => 'nullable|date',
            'id_rol' => 'required|exists:roles_usuarios,id',
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

        // Encriptar la contraseña antes de guardar
        $datos['password'] = bcrypt($datos['password']);
        Usuarios::create($datos);

        return redirect('/usuarios')->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Usuarios::find($id);
        return view('Usuarios.read')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Usuarios::find($id);
        $paises = Paises::select('id', 'nombre')
                  ->where('status', 1)
                  ->orderBy('nombre')
                  ->get();
        $tipos_usuario = Roles_Usuarios::select('id', 'nombre')
                        ->where('status', 1)
                        ->orderBy('nombre')
                        ->get();
        return view('Usuarios.edit')
               ->with('user', $user)
               ->with('paises', $paises)
               ->with('tipos_usuario', $tipos_usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:50',
            'ap_pat' => 'required|string|max:50',
            'ap_mat' => 'nullable|string|max:50',
            'username' => 'required|string|max:50|unique:usuarios,username,' . $id,
            'email' => 'required|email|max:100|unique:usuarios,email,' . $id,
            'telefono' => 'nullable|string|max:15',
            'genero' => 'nullable|string|max:20|in:M,F,O',
            'fecha_nacimiento' => 'nullable|date',
            'id_rol' => 'required|exists:roles_usuarios,id',
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

        // Si se proporciona una nueva contraseña, encriptarla
        if (!empty($datos['password'])) {
            $datos['password'] = bcrypt($datos['password']);
        } else {
            unset($datos['password']); // No actualizar la contraseña si no se proporciona
        }

        $user = Usuarios::find($id);
        $user->update($datos);

        return redirect('/usuarios')->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Usuarios::find($id);
        $user->status = 0;
        $user->save();
        
        return redirect('/usuarios')->with('success', 'Usuario eliminado exitosamente');
    }
}