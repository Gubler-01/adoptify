<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gráfica 3D - Animales por Estado</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('code/highcharts.js') }}"></script>
    <script src="{{ asset('code/highcharts-3d.js') }}"></script>
    <script src="{{ asset('code/modules/exporting.js') }}"></script>
    <script src="{{ asset('code/modules/export-data.js') }}"></script>
</head>
<body>
    <h2>Animales por Estado</h2>  
    <div id="container" style="min-width: 600px; height: 500px; margin: 0 auto"></div>
    <br /><br />
    <a href="{{ url('graficas') }}" class="button">Regresar</a>
</body>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 20, // Aumentamos el ángulo para un efecto 3D más pronunciado
            beta: 20,
            depth: 70, // Mayor profundidad
            viewDistance: 25
        }
    },
    title: {
        text: 'Animales por Estado (Activo, En Proceso, Adoptado)'
    },
    xAxis: {
        categories: @json(array_column($data, 'name')),
        title: {
            text: 'Estado'
        }
    },
    yAxis: {
        title: {
            text: 'Cantidad de Animales'
        },
        allowDecimals: false
    },
    series: [{
        name: 'Animales',
        data: @json(array_column($data, 'y')),
        color: '#007bff' // Azul para diferenciar de la gráfica de barras
    }],
    plotOptions: {
        column: {
            depth: 40, // Mayor profundidad para el efecto 3D
            dataLabels: {
                enabled: true,
                format: '{point.y}',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }
    },
    tooltip: {
        pointFormat: 'Cantidad: <b>{point.y}</b>'
    }
});
</script>
</html>