<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gráfica de Pastel - Distribución por Tipo de Animal</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('code/highcharts.js') }}"></script>
    <script src="{{ asset('code/highcharts-3d.js') }}"></script>
    <script src="{{ asset('code/modules/exporting.js') }}"></script>
    <script src="{{ asset('code/modules/export-data.js') }}"></script>
</head>
<body>
    <h2>Distribución de Animales por Tipo</h2>          
    <div id="container" style="height: 600px"></div>
    <br /><br />
    <a href="{{ url('graficas') }}" class="button">Regresar</a>
</body>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Distribución de Animales por Tipo'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Animales',
        colorByPoint: true,
        data: @json($data)
    }]
});
</script>
</html>