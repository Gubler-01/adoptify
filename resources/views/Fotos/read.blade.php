<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Foto</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de la Foto</h1>
    <div class="detail">
        <p><strong>Animal:</strong> {{ $foto->animales->nombre }}</p>
        <p><strong>Foto:</strong></p>
        <img src="../../storage/fotografias/{!! $foto->url_foto !!}" height="150px" />
        <p><strong>Fecha de Subida:</strong> {{ $foto->fecha_subida }}</p>
        <p><strong>Status:</strong> {{ $foto->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('fotos') !!}" class="button">REGRESAR A LAS FOTOS</a>
</div>
</body>
</html>