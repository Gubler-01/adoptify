<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3</title>
    <!-- Gráficas con Highcharts.js -->
    <script src="{!! asset('code/highcharts-3d.js') !!}"></script>
    <script src="{!! asset('code/highcharts.js') !!}"></script>
    <script src="{!! asset('code/modules/exporting.js') !!}"></script>
    <script src="{!! asset('code/modules/export-data.js') !!}"></script>
</head>
<body>

<ol>
          <li><a href="{!! asset('bienvenida') !!}">Home</a></li>
          <li><a href="{!! asset('graficas') !!}">Graficas</a></li>
          <li>Ventas mensuales</li>
        </ol>
<h2>Ventas mensuales</h2>          
       
            <div id="container" style="height: 600px"></div>
       

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
        text: 'Porcentaje de ventas del autos en el mes de Junio por marca'
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
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Porcentaje',
        data: [
            ['Nissan', 45.0],
            ['VW', 26.8],
            {
                name: 'Mazda',
                y: 12.8,
                sliced: true,
                selected: true
            },
            ['Chevrolette', 8.5],
            ['Ford', 6.2],
            ['Toyota3', 0.7],
            ['Toyota4', 5.7],
            ['Toyota6', 23.7]
        ]
    }]
});

</script>



</html>
