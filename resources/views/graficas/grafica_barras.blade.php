<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gráfica de Barras - Animales por Refugio</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('code/highcharts.js') }}"></script>
    <script src="{{ asset('code/modules/exporting.js') }}"></script>
    <script src="{{ asset('code/modules/export-data.js') }}"></script>
</head>
<body>
    <h2>Número de Animales por Refugio</h2>
    <div id="container_g" style="min-width: 610px; height: 500px; margin: 0 auto"></div>
    <br /><br />
    <a href="{{ url('graficas') }}" class="button">Regresar</a>
</body>
<script type="text/javascript">
    Highcharts.chart('container_g', {
        chart: {
            type: 'column' // Mantenemos el tipo como columnas, pero sin 3D
        },
        title: {
            text: 'Número de Animales por Refugio'
        },
        xAxis: {
            categories: @json(array_column($data, 'name')),
            title: {
                text: 'Refugios'
            },
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
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
            color: '#28a745' // Verde más claro para diferenciar
        }],
        plotOptions: {
            column: {
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