<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificado de Adopción</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            border: 2px solid #00a65a;
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            color: #00a65a;
            font-size: 28px;
        }
        h2 {
            font-size: 20px;
            color: #444;
        }
        .info-section {
            margin: 20px 0;
            text-align: left;
        }
        .info-section p {
            margin: 5px 0;
            font-size: 16px;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Certificado de Adopción</h1>
        <h2>Adoptify - {{ $date }}</h2>
        
        <div class="info-section">
            <h3>Información del Animal</h3>
            <p><strong>Nombre:</strong> {{ $data_animal->nombre }}</p>
            <p><strong>Edad:</strong> {{ $data_animal->edad }} años</p>
            <p><strong>Raza:</strong> {{ $data_animal->raza }}</p>
            <p><strong>Tipo de Animal:</strong> {{ $data_animal->tipos_animales->nombre }}</p>
            <p><strong>Status:</strong>
                @if($data_animal->status == 1) Activo
                @elseif($data_animal->status == 2) En Proceso
                @elseif($data_animal->status == 3) Adoptado
                @else Desconocido
                @endif
            </p>
        </div>

        <div class="info-section">
            <h3>Información del Refugio</h3>
            <p><strong>Nombre:</strong> {{ $data_refugio->nombre }}</p>
            <p><strong>Dirección:</strong> {{ $data_refugio->calle }} {{ $data_refugio->numero_exterior }}, Col. {{ $data_refugio->colonia }}, {{ $data_municipio->nombre }}</p>
            <p><strong>Código Postal:</strong> {{ $data_refugio->codigo_postal }}</p>
        </div>

        <div class="footer">
            <p>Gracias por adoptar con Adoptify. ¡Cuidemos juntos a nuestras mascotas!</p>
        </div>
    </div>
</body>
</html>