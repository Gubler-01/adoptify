<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Solicitud de Adopción</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de solicitud de adopción</h1>
    <div class="detail">
        <p><strong>Animal:</strong> {{ $solicitud->animales->nombre }}</p>
        <p><strong>Adoptante:</strong> {{ $solicitud->usuarios->nombre }} {{ $solicitud->usuarios->ap_pat }} {{ $solicitud->usuarios->ap_mat }}</p>
        <p><strong>Fecha de Solicitud:</strong> {{ $solicitud->fecha_solicitud }}</p>
        <p><strong>Estado:</strong> {{ $solicitud->estado }}</p>
        <p><strong>Status:</strong> {{ $solicitud->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('solicitudes-adopcion') !!}" class="button">REGRESAR A LAS SOLICITUDES</a>
</div>
</body>
</html>