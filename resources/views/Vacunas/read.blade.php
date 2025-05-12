<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Vacuna</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de vacuna</h1>
    <div class="detail">
        <p><strong>Animal:</strong> {{ $vacuna->animales->nombre }}</p>
        <p><strong>Nombre de la Vacuna:</strong> {{ $vacuna->catalogo_vacunas->nombre }}</p>
        <p><strong>Fecha de Aplicación:</strong> {{ $vacuna->fecha_aplicacion }}</p>
        <p><strong>Status:</strong> {{ $vacuna->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('vacunas') !!}" class="button">REGRESAR A LAS VACUNAS</a>
</div>
</body>
</html>