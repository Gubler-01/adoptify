<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Animal</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de animal</h1>
    <div class="detail">
        <p><strong>Nombre:</strong> {{ $animal->nombre }}</p>
        <p><strong>Edad:</strong> {{ $animal->edad }}</p>
        <p><strong>Raza:</strong> {{ $animal->raza }}</p>
        <p><strong>Tipo de Animal:</strong> {{ $animal->tipos_animales->nombre }}</p>
        <p><strong>Refugio:</strong> {{ $animal->refugios->nombre }}</p>
        <p><strong>Status:</strong> {{ $animal->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('animales') !!}" class="button">REGRESAR A LOS ANIMALES</a>
</div>
</body>
</html>