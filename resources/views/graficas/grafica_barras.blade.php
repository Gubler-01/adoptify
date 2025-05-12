<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2</title>

    <!-- Gráficas con Highcharts.js -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="{!! asset('code/highcharts.js') !!}"></script>
    <script src="{!! asset('code/highcharts-3d.js') !!}"></script>
    <script src="{!! asset('code/modules/exporting.js') !!}"></script>
    <script src="{!! asset('code/modules/export-data.js') !!}"></script>



</head>
<body>

<ol>
          <li><a href="{!! asset('bienvenida') !!}">Home</a></li>
          <li><a href="{!! asset('graficas') !!}">Graficas</a></li>
          <li>Comportamiento general</li>
        </ol>

        <h2>Comportamiento general</h2>
        <div id="container_g" style="min-width: 610px; height: 500px; margin: 0 auto"></div>
<div id="sliders_g">
    <table>
        <tr>
            <td>Alpha Angle</td>
            <td><input id="alpha" type="range" min="0" max="45" value="15"/> <span id="alpha-value" class="value"></span></td>
        </tr>
        <tr>
            <td>Beta Angle</td>
            <td><input id="beta" type="range" min="-45" max="45" value="15"/> <span id="beta-value" class="value"></span></td>
        </tr>
        <tr>
            <td>Profundidad</td>
            <td><input id="depth" type="range" min="20" max="100" value="50"/> <span id="depth-value" class="value"></span></td>
        </tr>
    </table>
</div>           


</body>

<script type="text/javascript">

// Set up the chart
var chart = new Highcharts.Chart({
    chart: {
        renderTo: 'container_g',
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }
    },
    title: {
        text: 'Número de alumnos aprobados'
    },
    subtitle: {
        text: 'Por semestre'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    series: [{
        data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    }]
});

function showValues() {
    $('#alpha-value').html(chart.options.chart.options3d.alpha);
    $('#beta-value').html(chart.options.chart.options3d.beta);
    $('#depth-value').html(chart.options.chart.options3d.depth);
}

// Activate the sliders
$('#sliders_g input').on('input change', function () {
    chart.options.chart.options3d[this.id] = parseFloat(this.value);
    showValues();
    chart.redraw(false);
});

showValues();
</script>


</html>
