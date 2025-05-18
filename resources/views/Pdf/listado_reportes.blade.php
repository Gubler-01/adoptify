<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportes en PDF</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function buscar_animales(id_refugio, id_tipo_animal) {
            if (id_refugio == 0) {
                $("#lista_animales").html('');
                $("#id_tipo_animal").val(0);
                return;
            }
            $.ajax({
                type: 'GET',
                url: 'buscar_animales_por_tipo/' + id_tipo_animal + '/' + id_refugio,
                success: function(data) {
                    $("#lista_animales").html(data);
                }
            });
        }

        function generar_reporte(tipo) {
            var id_refugio = $("#id_refugio").val();
            var id_tipo_animal = $("#id_tipo_animal").val();
            if (id_refugio == 0) {
                alert('Por favor, selecciona un refugio.');
                return;
            }
            var url = "{{ url('animales_por_refugio_y_tipo') }}/" + tipo + "/" + id_refugio + "/" + id_tipo_animal;
            window.open(url, '_blank');
        }

        function generar_certificado(tipo) {
            var id_animal = $("#id_animal").val();
            if (id_animal == 0) {
                alert('Por favor, selecciona un animal.');
                return;
            }
            var url = "{{ url('certificado_adopcion') }}/" + tipo + "/" + id_animal;
            window.open(url, '_blank');
        }

        // Función para ajustar la tabla y eliminar columnas "Status" y "Acciones"
        function ajustarTabla() {
            var table = $("#lista_animales table");
            if (table.length) {
                // Eliminar la columna "Status" (índice 5)
                table.find('thead th:nth-child(6), tbody td:nth-child(6)').remove();
                // Eliminar la columna "Acciones" (índice 7, después de eliminar Status)
                table.find('thead th:nth-child(6), tbody td:nth-child(6)').remove();
            }
        }

        // Llamar a ajustarTabla después de cargar los datos AJAX
        $(document).ajaxComplete(function() {
            ajustarTabla();
        });
    </script>
</head>
<body>
<div class="container">
    <h2>Reportes en PDF</h2>

    <!-- Formulario para seleccionar refugio y tipo de animal -->
    <h3>Generar Reporte de Animales</h3>
    <label for="id_refugio">Seleccionar Refugio</label>
    <select name="id_refugio" id="id_refugio" onchange="buscar_animales(this.value, $('#id_tipo_animal').val());">
        <option value="0">Seleccionar...</option>
        @foreach($refugios as $refugio)
            <option value="{{ $refugio->id }}">{{ $refugio->nombre }}</option>
        @endforeach
    </select>
    <br /><br />

    <label for="id_tipo_animal">Seleccionar Tipo de Animal</label>
    <select name="id_tipo_animal" id="id_tipo_animal" onchange="buscar_animales($('#id_refugio').val(), this.value);">
        <option value="0">Seleccionar...</option>
        @foreach($tipos_animales as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
        @endforeach
    </select>
    <br /><br />

    <button onclick="generar_reporte(1)">Ver Reporte</button>
    <button onclick="generar_reporte(2)">Descargar Reporte</button>
    <br /><br />

    <!-- Vista previa de animales (sin Status ni Acciones) -->
    <h3>Lista de Animales (Vista Previa)</h3>
    <div id="lista_animales"></div>
    <br /><br />

    <!-- Reporte 2: Certificado de Adopción -->
    <h3>Generar Certificado de Adopción</h3>
    <label for="id_animal">Seleccionar Animal</label>
    <select name="id_animal" id="id_animal">
        <option value="0">Seleccionar...</option>
        @foreach($animales as $animal)
            <option value="{{ $animal->id }}">{{ $animal->nombre }}</option>
        @endforeach
    </select>
    <br /><br />
    <button onclick="generar_certificado(1)">Ver Certificado</button>
    <button onclick="generar_certificado(2)">Descargar Certificado</button>
    <br /><br />

    <a href="{!! asset('cruds') !!}" class="button">Regresar a los CRUDs</a>
</div>
</body>
</html>