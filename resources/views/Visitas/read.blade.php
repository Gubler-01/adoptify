<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Visita</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de visita</h1>
    <div class="detail">
        <p><strong>Solicitud:</strong> Solicitud #{{ $visita->id_solicitud }} - Animal: {{ $visita->solicitudes_adopcion->animales->nombre }} - Adoptante: {{ $visita->solicitudes_adopcion->usuarios->nombre }} {{ $visita->solicitudes_adopcion->usuarios->ap_pat }} {{ $visita->solicitudes_adopcion->usuarios->ap_mat }}</p>
        <p><strong>Fecha de Visita:</strong> {{ $visita->fecha_visita }}</p>
        <p><strong>Comentarios:</strong> {{ $visita->comentarios }}</p>
        <p><strong>Status:</strong> {{ $visita->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('visitas') !!}" class="button">REGRESAR A LAS VISITAS</a>
</div>
</body>
</html>