<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Refugios</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Refugios</h1>
    <a href="{!! asset('refugios/create') !!}" class="button">Crear un nuevo refugio</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Calle</th>
                <th>Número Exterior</th>
                <th>Número Interior</th>
                <th>Código Postal</th>
                <th>Colonia</th>
                <th>Municipio</th>
                <th>Usuario</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($refugios as $refugio)
            <tr>
                <td>{{ $refugio->id }}</td>
                <td>{{ $refugio->nombre }}</td>
                <td>{{ $refugio->calle }}</td>
                <td>{{ $refugio->numero_exterior }}</td>
                <td>{{ $refugio->numero_interior }}</td>
                <td>{{ $refugio->codigo_postal }}</td>
                <td>{{ $refugio->colonia }}</td>
                <td>{{ $refugio->municipios->nombre }}</td>
                <td>{{ $refugio->usuarios->nombre }} {{ $refugio->usuarios->ap_pat }} {{ $refugio->usuarios->ap_mat }}</td>
                <td>{{ $refugio->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('refugios/' . $refugio->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('refugios/' . $refugio->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('refugios/' . $refugio->id) !!}" style="display:inline;">
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