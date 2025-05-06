<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Solicitudes de Adopción</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Solicitudes de Adopción</h1>
    <a href="{!! asset('solicitudes-adopcion/create') !!}" class="button">Crear una nueva solicitud</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Animal</th>
                <th>Adoptante</th>
                <th>Fecha de Solicitud</th>
                <th>Estado</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->id }}</td>
                <td>{{ $solicitud->animales->nombre }}</td>
                <td>{{ $solicitud->usuarios->nombre }} {{ $solicitud->usuarios->ap_pat }} {{ $solicitud->usuarios->ap_mat }}</td>
                <td>{{ $solicitud->fecha_solicitud }}</td>
                <td>{{ $solicitud->estado }}</td>
                <td>{{ $solicitud->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('solicitudes-adopcion/' . $solicitud->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('solicitudes-adopcion/' . $solicitud->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('solicitudes-adopcion/' . $solicitud->id) !!}" style="display:inline;">
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