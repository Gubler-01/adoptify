<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Municipios</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Lista de Municipios</h1>

    <a href="{{ route('municipios.create') }}" class="button">Crear Nuevo Municipio</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Entidad</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($municipios as $municipio)
            <tr>
                <td>{{ $municipio->id }}</td>
                <td>{{ $municipio->nombre }}</td>
                <td>{{ $municipio->entidades->nombre }}</td>
                <td>{{ $municipio->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{{ route('municipios.show', $municipio->id) }}" class="button">Detalle</a>
                    <a href="{{ route('municipios.edit', $municipio->id) }}" class="button">Editar</a>
                    <form method="POST" action="{{ route('municipios.destroy', $municipio->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>