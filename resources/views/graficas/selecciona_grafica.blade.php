@extends('template.master')
@section('contenido')

    <h2>Gráficas - Adoptify</h2>  
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>Tipo de Gráfica</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            <tr class="odd gradeX">
                <td>Número de animales por refugio</td>
                <td>
                    <a href="{{ url('grafica_barras') }}"><button class="btn btn-block btn-primary btn-xs">Ver</button></a>
                </td>
            </tr>
            <tr class="odd gradeX">
                <td>Distribución de animales por tipo</td>
                <td>
                    <a href="{{ url('grafica_pie') }}"><button class="btn btn-block btn-primary btn-xs">Ver</button></a>
                </td>
            </tr>
            <tr class="odd gradeX">
                <td>Animales por estado (3D)</td>
                <td>
                    <a href="{{ url('grafica_3d') }}"><button class="btn btn-block btn-primary btn-xs">Ver</button></a>
                </td>
            </tr>
        </tbody>
    </table>
    <br /><br />
    <a href="{{ asset('menu') }}" class="button">Regresar al menu</a>
@endsection