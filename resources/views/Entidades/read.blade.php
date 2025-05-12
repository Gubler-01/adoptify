<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Entidad</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de entidad</h1>
    <div class="detail">
        <p><strong>Clave de pais:</strong> {{ $entidad->id_pais }}</p>
        <p><strong>Pais:</strong> {{ $entidad->paises->nombre }}</p>
        <p><strong>Nombre:</strong> {{ $entidad->nombre }}</p>
        <p><strong>Status:</strong> {{ $entidad->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('entidades') !!}" class="button">REGRESAR A ENTIDADES</a>
</div>
</body>
</html>