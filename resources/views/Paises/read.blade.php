<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Pais</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de pais</h1>
    <div class="detail">
        <p><strong>Nombre:</strong> {{ $pais->nombre }}</p>
        <p><strong>Clave:</strong> {{ $pais->clave }}</p>
        <p><strong>Status:</strong> {{ $pais->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('paises') !!}" class="button">REGRESAR A LOS PAISES</a>
</div>
</body>
</html>