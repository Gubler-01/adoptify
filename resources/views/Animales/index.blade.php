<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Animales</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Animales</h1>
    <a href="{!! asset('animales/create') !!}" class="button">Crear un nuevo animal</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Raza</th>
                <th>Tipo de Animal</th>
                <th>Refugio</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($animales as $animal)
            <tr>
                <td>{{ $animal->id }}</td>
                <td>{{ $animal->nombre }}</td>
                <td>{{ $animal->edad }}</td>
                <td>{{ $animal->raza }}</td>
                <td>{{ $animal->tipos_animales->nombre }}</td>
                <td>{{ $animal->refugios->nombre }}</td>
                <td>{{ $animal->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('animales/' . $animal->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('animales/' . $animal->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('animales/' . $animal->id) !!}" style="display:inline;">
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