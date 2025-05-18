<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Animales</title>
    <style>
        .col-md-12 {
            width: 100%;
        } 

        .box {
            position: relative;
            border-radius: 3px;
            background: #ffffff;
            border-top: 3px solid #d2d6de;
            margin-bottom: 20px;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            background-color: #ECF0F5;
        }

        .box-header {
            color: #444;
            display: block;
            padding: 10px;
            position: relative;
        }

        .box-header.with-border {
            border-bottom: 1px solid #f4f4f4;
        }

        .box-header .box-title {
            display: inline-block;
            font-size: 18px;
            margin: 0;
            line-height: 1;
        }

        .box-body {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            padding: 10px;
        }

        .box-footer {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px;
            border-top: 1px solid #f4f4f4;
            padding: 10px;
            background-color: #fff;
        }

        .table-bordered {
            border: 1px solid #f4f4f4;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }

        table {
            background-color: transparent;
        }

        .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1px solid #f4f4f4;
        }

        .badge {
            display: inline-block;
            min-width: 10px;
            padding: 3px 7px;
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            background-color: #777;
            border-radius: 10px;
        }

        .bg-green {
            background-color: #00a65a !important;
        }
    </style>
</head>
<body>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Reporte de Animales - {{ $date }}</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th style="width: 40px">Nombre</th>
                            <th style="width: 40px">Edad</th>
                            <th style="width: 40px">Raza</th>
                            <th style="width: 40px">Tipo de Animal</th>
                            <th style="width: 40px">Refugio</th>
                            <th style="width: 40px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $animal)
                            <tr>
                                <td style="width: 10px">{{ $animal->id }}</td>
                                <td>{{ $animal->nombre }}</td>
                                <td>{{ $animal->edad }}</td>
                                <td>{{ $animal->raza }}</td>
                                <td>{{ $animal->tipos_animales->nombre }}</td>
                                <td>{{ $animal->refugios->nombre }}</td>
                                <td>
                                    <span class="badge bg-green">
                                        @if($animal->status == 1) Activo
                                        @elseif($animal->status == 2) En Proceso
                                        @elseif($animal->status == 3) Adoptado
                                        @else Desconocido
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <p>Generado para Refugio ID: {{ request()->segment(2) }}, Tipo de Animal ID: {{ request()->segment(3) }}</p>
            </div>
        </div>
    </div>
</body>
</html>