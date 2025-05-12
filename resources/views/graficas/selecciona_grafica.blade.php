<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>graficas</title>
</head>
<body>
 <h2>Gráficas</h2>  
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TIPO DE GRÁFICA</th>
                        <th>VER</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd gradeX">
                        <td>1</td>
                        <td>Histórico de comentarios</td>
                        <td>
                        <a href="{!! asset('grafica_areas') !!}" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a>
                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>2</td>
                        <td>Comportamiento general</td>
                        <td>
                        <a href="{!! asset('grafica_barras') !!}" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a>
                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>3</td>
                        <td>Ventas mensuales</td>
                        <td>
                        <a href="{!! asset('grafica_pie') !!}" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a>
                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>4</td>
                        <td>Gráfica con datos DB</td>
                        <td>
                        <a href="{!! asset('grafica_3d') !!}" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a>
                        </td>
                    </tr>
                    
                </tbody>
            </table>

</body>
</html>
    