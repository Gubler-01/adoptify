<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Adopciones</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Adopciones</h1>
    <a href="{!! asset('adopciones/create') !!}" class="button">Crear una nueva adopción</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Solicitud</th>
                <th>Animal</th>
                <th>Adoptante</th>
                <th>Fecha de Adopción</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adopciones as $adopcion)
            <tr>
                <td>{{ $adopcion->id }}</td>
                <td>{{ $adopcion->id_solicitud }}</td>
                <td>{{ $adopcion->solicitudes_adopcion->animales->nombre }}</td>
                <td>{{ $adopcion->solicitudes_adopcion->usuarios->nombre }} {{ $adopcion->solicitudes_adopcion->usuarios->ap_pat }} {{ $adopcion->solicitudes_adopcion->usuarios->ap_mat }}</td>
                <td>{{ $adopcion->fecha_adopcion }}</td>
                <td>{{ $adopcion->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('adopciones/' . $adopcion->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('adopciones/' . $adopcion->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('adopciones/' . $adopcion->id) !!}" style="display:inline;">
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