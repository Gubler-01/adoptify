<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3d</title>

    <!-- Gráficas con Highcharts.js -->
    <script src="{!! asset('code/highcharts.js') !!}"></script>
    <script src="{!! asset('code/modules/exporting.js') !!}"></script>
    <script src="{!! asset('code/modules/export-data.js') !!}"></script>


</head>
<body>
    <h1>Gráfica</h1>

        <ol>
          <li><a href="{!! asset('bienvenida') !!}">Home</a></li>
          <li><a href="{!! asset('graficas') !!}">Graficas</a></li>
          <li>Gráfica con datos DB</li>
        </ol>

        <h2>Gráfica con datos DB</h2>  
          <h2>Existencias de Productos</h2> 


          <h2>Gráfica con datos DB</h2>  
          <h2>Existencias de Productos</h2>          
        

        <?php
        $campos = "";
        foreach($productos as $prod){
        $campos = $campos."[ '".$prod->nombre."' , ".$prod->existencia."],";  
        }
        ?>

        <?= $campos; ?>

        <div id="container" style="min-width: 600px; height: 500px; margin: 0 auto"></div>
        



<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Cantidad de existencias por productos'
    },
    subtitle: {
        text: 'Mes de Mayo'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total de existencia'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Total de existencia: <b>{point.y:.0f} </b>'
    },
    series: [{
        name: 'Population',
        data: [

            <?= $campos ?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.0f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

</script>


</body>
</html>
    
