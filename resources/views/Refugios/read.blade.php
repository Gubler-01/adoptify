<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Refugio</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de refugio</h1>
    <div class="detail">
        <p><strong>Nombre:</strong> {{ $refugio->nombre }}</p>
        <p><strong>Calle:</strong> {{ $refugio->calle }}</p>
        <p><strong>Número Exterior:</strong> {{ $refugio->numero_exterior }}</p>
        <p><strong>Número Interior:</strong> {{ $refugio->numero_interior }}</p>
        <p><strong>Código Postal:</strong> {{ $refugio->codigo_postal }}</p>
        <p><strong>Colonia:</strong> {{ $refugio->colonia }}</p>
        <p><strong>Municipio:</strong> {{ $refugio->municipios->nombre }}</p>
        <p><strong>Usuario:</strong> {{ $refugio->usuarios->nombre }} {{ $refugio->usuarios->ap_pat }} {{ $refugio->usuarios->ap_mat }}</p>
        <p><strong>Status:</strong> {{ $refugio->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('refugios') !!}" class="button">REGRESAR A LOS REFUGIOS</a>
</div>
</body>
</html>