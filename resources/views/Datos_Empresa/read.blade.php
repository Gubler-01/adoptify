<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Datos de Empresa</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de datos de empresa</h1>
    <div class="detail">
        <p><strong>Usuario Responsable:</strong> {{ $dato_empresa->usuarios->nombre }} {{ $dato_empresa->usuarios->ap_pat }} {{ $dato_empresa->usuarios->ap_mat }}</p>
        <p><strong>Calle:</strong> {{ $dato_empresa->calle }}</p>
        <p><strong>Número Exterior:</strong> {{ $dato_empresa->numero_exterior }}</p>
        <p><strong>Número Interior:</strong> {{ $dato_empresa->numero_interior }}</p>
        <p><strong>Código Postal:</strong> {{ $dato_empresa->codigo_postal }}</p>
        <p><strong>Colonia:</strong> {{ $dato_empresa->colonia }}</p>
        <p><strong>Misión:</strong> {{ $dato_empresa->mision }}</p>
        <p><strong>Valores:</strong> {{ $dato_empresa->valores }}</p>
        <p><strong>Teléfono:</strong> {{ $dato_empresa->telefono }}</p>
        <p><strong>Correo:</strong> {{ $dato_empresa->correo }}</p>
        <p><strong>Sitio Web:</strong> {{ $dato_empresa->sitio_web }}</p>
        <p><strong>Latitud:</strong> {{ $dato_empresa->latitud }}</p>
        <p><strong>Longitud:</strong> {{ $dato_empresa->longitud }}</p>
        <p><strong>Facebook:</strong> {{ $dato_empresa->facebook }}</p>
        <p><strong>X:</strong> {{ $dato_empresa->x }}</p>
        <p><strong>Instagram:</strong> {{ $dato_empresa->instagram }}</p>
        <p><strong>Status:</strong> {{ $dato_empresa->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('datos-empresa') !!}" class="button">REGRESAR A LOS DATOS DE EMPRESA</a>
</div>
</body>
</html>