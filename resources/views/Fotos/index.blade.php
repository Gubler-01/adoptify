<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Fotos</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Fotos</h1>
    <a href="{!! asset('fotos/create') !!}" class="button">Crear una nueva foto</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Animal</th>
                <th>Imagen</th>
                <th>Ruta</th>
                <th>Fecha de Subida</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fotos as $foto)
            <tr>
                <td>{{ $foto->id }}</td>
                <td>{{ $foto->animales->nombre }}</td>
                <td><img src="../storage/fotografias/{!! $foto->url_foto !!}" height="150px" /></td>
                <td>{{ $foto->url_foto }}</td>
                <td>{{ $foto->fecha_subida }}</td>
                <td>{{ $foto->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('fotos/' . $foto->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('fotos/' . $foto->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('fotos/' . $foto->id) !!}" style="display:inline;">
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