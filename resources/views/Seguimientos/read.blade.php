<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Seguimiento</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de seguimiento</h1>
    <div class="detail">
        <p><strong>Adopción:</strong> Adopción #{{ $seguimiento->id_adopcion }} - Solicitud #{{ $seguimiento->adopciones->id_solicitud }} - Animal: {{ $seguimiento->adopciones->solicitudes_adopcion->animales->nombre }} - Adoptante: {{ $seguimiento->adopciones->solicitudes_adopcion->usuarios->nombre }} {{ $seguimiento->adopciones->solicitudes_adopcion->usuarios->ap_pat }} {{ $seguimiento->adopciones->solicitudes_adopcion->usuarios->ap_mat }}</p>
        <p><strong>Fecha de Seguimiento:</strong> {{ $seguimiento->fecha_seguimiento }}</p>
        <p><strong>Observaciones:</strong> {{ $seguimiento->observaciones }}</p>
        <p><strong>Status:</strong> {{ $seguimiento->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('seguimientos') !!}" class="button">REGRESAR A LOS SEGUIMIENTOS</a>
</div>
</body>
</html>