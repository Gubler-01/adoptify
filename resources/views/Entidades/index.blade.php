<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Entidades</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Entidades</h1>
    <a href="{!! asset('entidades/create') !!}" class="button">Crear un nueva Entidad</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID pais</th>
                <th>Nombre de pais</th>
                <th>Nombre</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entidades as $entidad)
            <tr>
                <td>{{ $entidad->id }}</td>
                <td>{{ $entidad->id_pais }}</td>
                <td>{{ $entidad->paises->nombre }}</td>
                <td>{{ $entidad->nombre }}</td>
                <td>{{ $entidad->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('entidades/' . $entidad->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('entidades/' . $entidad->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{{ route('entidades.destroy', $entidad->id) }}" style="display:inline;">
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