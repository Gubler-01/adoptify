<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Adopción</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de adopción</h1>
    <div class="detail">
        <p><strong>Solicitud:</strong> Solicitud #{{ $adopcion->id_solicitud }}</p>
        <p><strong>Animal:</strong> {{ $adopcion->solicitudes_adopcion->animales->nombre }}</p>
        <p><strong>Adoptante:</strong> {{ $adopcion->solicitudes_adopcion->usuarios->nombre }} {{ $adopcion->solicitudes_adopcion->usuarios->ap_pat }} {{ $adopcion->solicitudes_adopcion->usuarios->ap_mat }}</p>
        <p><strong>Fecha de Adopción:</strong> {{ $adopcion->fecha_adopcion }}</p>
        <p><strong>Status:</strong> {{ $adopcion->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('adopciones') !!}" class="button">REGRESAR A LAS ADOPCIONES</a>
</div>
</body>
</html>