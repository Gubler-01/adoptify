<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pdf</title>
</head>
<body>
    <h2>Reportes en PDF</h2>          
    <table width="100%" border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>REPORTE</th>
                        <th>VER</th>
                        <th>DESCARGAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ver productos ordenados por nombre</td>
                        <td>
                        <a href="{!! asset('productos_nombre/1') !!}" target="_blank" >Ver</a>
                        </td>
                        <td>
                        <a href="{!! asset('productos_nombre/2') !!}" target="_blank" >Descargar</a>
                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>2</td>
                        <td>Ver Ticket</td>
                        <td>
                        <a href="{!! asset('ticket/1/9') !!}" target="_blank" >Ver</a>
                        </td>
                        <td>
                        <a href="{!! asset('ticket/2/9') !!}" target="_blank" >Descargar</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        

</body>
</html>