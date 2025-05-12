<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle del Municipio</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle del Municipio</h1>
    <div class="detail">
        <p><strong>ID:</strong> {{ $municipio->id }}</p>
        <p><strong>Nombre:</strong> {{ $municipio->nombre }}</p>
        <p><strong>Entidad:</strong> {{ $municipio->entidades->nombre }}</p>
        <p><strong>Status:</strong> {{ $municipio->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <a href="{{ route('municipios.index') }}" class="button">Regresar</a>
</div>
</body>
</html>