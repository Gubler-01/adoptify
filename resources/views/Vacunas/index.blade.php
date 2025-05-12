<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Vacunas</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Vacunas</h1>
    <a href="{!! asset('vacunas/create') !!}" class="button">Crear una nueva vacuna</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Animal</th>
                <th>Nombre de la Vacuna</th>
                <th>Fecha de Aplicación</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacunas as $vacuna)
            <tr>
                <td>{{ $vacuna->id }}</td>
                <td>{{ $vacuna->animales->nombre }}</td>
                <td>{{ $vacuna->catalogo_vacunas->nombre }}</td>
                <td>{{ $vacuna->fecha_aplicacion }}</td>
                <td>{{ $vacuna->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('vacunas/' . $vacuna->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('vacunas/' . $vacuna->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('vacunas/' . $vacuna->id) !!}" style="display:inline;">
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