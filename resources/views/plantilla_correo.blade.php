<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Correo Adoptify</title>
    <style>
        .titulo {
            color: #00a65a; /* Verde amigable, usado en los reportes PDF */
            padding-top: 20px;
            padding-bottom: 10px;
            padding-left: 20px;
            padding-right: 20px;
            text-align: center;
        }

        .body {
            background-color: #f5f5f5; /* Fondo gris claro, más cálido */
        }

        .div_contenido {
            color: #5c4033; /* Marrón oscuro para el texto, evocando tonos naturales */
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #ffffff !important;
            border-radius: 8px;
            margin: 0 auto;
            max-width: 600px;
            font-size: 16px;
            line-height: 1.5;
        }

        .div_footer {
            color: #00a65a; /* Verde para el footer */
            font-size: 14px;
            padding-top: 20px;
            padding-bottom: 10px;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #ffffff !important;
            border-radius: 8px;
            margin: 10px auto;
            max-width: 600px;
            text-align: center;
        }

        hr {
            border: 0;
            border-top: 1px solid #e0e0e0;
            margin: 10px 0;
        }
    </style>
</head>
<body class="body">
    <div class="titulo">
        <h1>¡Bienvenido(a) a Adoptify!</h1>
    </div>
    <hr>
    <div class="div_contenido">
        <?= $contenido; ?>
    </div>
    <div class="div_footer">
        ¡Gracias por unirte a nuestra misión de encontrar hogares para nuestras mascotas!<br/>
        Adoptify - Juntos por un mundo con más amor animal 🐾<br/>
        _____________________________________________<br/>
        Equipo Adoptify<br/>
        <a href="mailto:contacto@adoptify.com">contacto@adoptify.com</a><br/>
    </div>
</body>
</html>