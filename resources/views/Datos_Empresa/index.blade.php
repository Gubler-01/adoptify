<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Datos de la Empresa</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Listado de Datos de la Empresa</h1>
    <a href="{!! asset('datos-empresa/create') !!}" class="button">Crear nuevos datos de empresa</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario Responsable</th>
                <th>Calle</th>
                <th>Número Exterior</th>
                <th>Número Interior</th>
                <th>Código Postal</th>
                <th>Colonia</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datos_empresa as $dato_empresa)
            <tr>
                <td>{{ $dato_empresa->id }}</td>
                <td>{{ $dato_empresa->usuarios->nombre }} {{ $dato_empresa->usuarios->ap_pat }} {{ $dato_empresa->usuarios->ap_mat }}</td>
                <td>{{ $dato_empresa->calle }}</td>
                <td>{{ $dato_empresa->numero_exterior }}</td>
                <td>{{ $dato_empresa->numero_interior }}</td>
                <td>{{ $dato_empresa->codigo_postal }}</td>
                <td>{{ $dato_empresa->colonia }}</td>
                <td>{{ $dato_empresa->telefono }}</td>
                <td>{{ $dato_empresa->correo }}</td>
                <td>{{ $dato_empresa->status ? 'Activo' : 'Baja' }}</td>
                <td>
                    <a href="{!! asset('datos-empresa/' . $dato_empresa->id) !!}" class="button">Detalle</a>
                    <a href="{!! asset('datos-empresa/' . $dato_empresa->id . '/edit') !!}" class="button">Editar</a>
                    <form method="POST" action="{!! asset('datos-empresa/' . $dato_empresa->id) !!}" style="display:inline;">
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