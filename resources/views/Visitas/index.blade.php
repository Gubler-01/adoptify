<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Visitas</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Visitas</h1>
    <a href="{!! asset('visitas/create') !!}" class="button">Crear una nueva visita</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Solicitud (Animal - Adoptante)</th>
                <th>Fecha de Visita</th>
                <th>Comentarios</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitas as $visita)
            <tr>
                <td>{{ $visita->id }}</td>
                <td>Solicitud #{{ $visita->id_solicitud }} - Animal: {{ $visita->solicitudes_adopcion->animales->nombre }} - Adoptante: {{ $visita->solicitudes_adopcion->usuarios->nombre }} {{ $visita->solicitudes_adopcion->usuarios->ap_pat }} {{ $visita->solicitudes_adopcion->usuarios->ap_mat }}</td>
                <td>{{ $visita->fecha_visita }}</td>
                <td>{{ $visita->comentarios }}</td>
                <td>{{ $visita->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('visitas/' . $visita->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('visitas/' . $visita->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('visitas/' . $visita->id) !!}" style="display:inline;">
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