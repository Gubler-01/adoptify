<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Seguimientos</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Seguimientos</h1>
    <a href="{!! asset('seguimientos/create') !!}" class="button">Crear un nuevo seguimiento</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Adopción (Solicitud - Animal - Adoptante)</th>
                <th>Fecha de Seguimiento</th>
                <th>Observaciones</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seguimientos as $seguimiento)
            <tr>
                <td>{{ $seguimiento->id }}</td>
                <td>Adopción #{{ $seguimiento->id_adopcion }} - Solicitud #{{ $seguimiento->adopciones->id_solicitud }} - Animal: {{ $seguimiento->adopciones->solicitudes_adopcion->animales->nombre }} - Adoptante: {{ $seguimiento->adopciones->solicitudes_adopcion->usuarios->nombre }} {{ $seguimiento->adopciones->solicitudes_adopcion->usuarios->ap_pat }} {{ $seguimiento->adopciones->solicitudes_adopcion->usuarios->ap_mat }}</td>
                <td>{{ $seguimiento->fecha_seguimiento }}</td>
                <td>{{ $seguimiento->observaciones }}</td>
                <td>{{ $seguimiento->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('seguimientos/' . $seguimiento->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('seguimientos/' . $seguimiento->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('seguimientos/' . $seguimiento->id) !!}" style="display:inline;">
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