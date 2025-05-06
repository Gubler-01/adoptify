<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Paises</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de paises</h1>
    <a href="{!! asset('paises/create') !!}" class="button">Crear un nuevo pais</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Clave</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paises as $pais)
            <tr>
                <td>{{ $pais->id }}</td>
                <td>{{ $pais->nombre }}</td>
                <td>{{ $pais->clave }}</td>
                <td>{{ $pais->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('paises/' . $pais->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('paises/' . $pais->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{{ route('paises.destroy', $pais->id) }}" style="display:inline;">
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