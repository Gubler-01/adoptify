<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejemplos AJAX</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Mecanismo 2: Consultar animales por refugio y tipo de animal
        function buscar_animales(id_refugio, id_tipo_animal) {
            // Si no se ha seleccionado un refugio, no hacemos la consulta
            if (id_refugio == 0) {
                $("#lista_animales").html('');
                $("#id_tipo_animal").val(0); // Resetear el combo de tipo de animal
                return;
            }
            // Si no se ha seleccionado un tipo de animal (id_tipo_animal = 0), mostramos todos los animales del refugio
            $.ajax({
                type: 'GET',
                url: 'buscar_animales_por_tipo/' + id_tipo_animal + '/' + id_refugio,
                success: function(data) {
                    $("#lista_animales").html(data);
                }
            });
        }

        // Mecanismo 3: Actualizar status de un animal
        function cambiar_status_animal(id_animal, id_tipo_animal, id_refugio) {
            $.ajax({
                type: 'GET',
                url: 'cambiar_status_animal/' + id_animal + '/' + id_tipo_animal + '/' + id_refugio,
                success: function(data) {
                    $("#lista_animales").html(data);
                }
            });
        }
    </script>
</head>
<body>
<div class="container">
    <h1>Consultar animales</h1>

    <!-- Mecanismo 2: Consultar animales por refugio y tipo de animal -->
    <h2>Ver animales por refugio y tipo</h2>
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
    <h2>Lista de Animales</h2>
    <div id="lista_animales"></div>
    <br /><br />

    <a href="{!! asset('cruds') !!}" class="button">REGRESAR A LOS CRUDS</a>
</div>
</body>
</html>