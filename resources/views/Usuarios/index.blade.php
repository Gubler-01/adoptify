<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Usuarios</h1>
    <a href="{!! asset('usuarios/create') !!}" class="button">Crear un nuevo usuario</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>País</th>
                <th>Entidad</th>
                <th>Municipio</th>
                <th>Password</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->roles_usuario->nombre }}</td>
                <td>{{ $user->nombre }} {{ $user->ap_pat }} {{ $user->ap_mat }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->municipios->entidades->paises->nombre }}</td>
                <td>{{ $user->municipios->entidades->nombre }}</td>
                <td>{{ $user->municipios->nombre }}</td>
                <td>{{ $user->password }}</td>
                <td>
                    <a href="{!! asset('usuarios/' . $user->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('usuarios/' . $user->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('usuarios/' . $user->id) !!}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br />
    <a href="{!! asset('cruds') !!}" class="button">REGRESAR A LOS CRUDS</a>
</div>
</body>
</html>