<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Municipio</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function cambiar_combo_entidad(id_pais) {
            $("#id_entidad").empty();
            var ruta = "{{ asset('combo_entidad_muni') }}/" + id_pais;
            $.ajax({
                type: 'GET',
                url: ruta,
                success: function(data) {
                    var entidades = data;
                    $('#id_entidad').append('<option value="">Seleccionar...</option>');
                    for (var i = 0; i < entidades.length; i++) {
                        $('#id_entidad').append('<option value="' + entidades[i].id + '" ' + (entidades[i].id == {{ old('id_entidad', $municipio->id_entidad) }} ? 'selected' : '') + '>' + entidades[i].nombre + '</option>');
                    }
                },
                error: function() {
                    alert('Error al cargar las entidades.');
                }
            });
        }

        // Cargar las entidades al inicio si hay un país seleccionado
        $(document).ready(function() {
            var id_pais = $('#id_pais').val();
            if (id_pais) {
                cambiar_combo_entidad(id_pais);
            }
        });
    </script>
</head>
<body>
<div class="container">
    <h1>Editar Municipio</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('municipios.update', $municipio->id) }}">
        @csrf
        @method('PUT')
        <label for="id_pais">Seleccionar País</label>
        <select name="id_pais" id="id_pais" onchange="cambiar_combo_entidad(this.value);">
            <option value="">Seleccionar...</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}" {{ old('id_pais', $municipio->entidades->id_pais) == $pais->id ? 'selected' : '' }}>{{ $pais->nombre }}</option>
            @endforeach
        </select>
        @error('id_pais')
            <span class="error">{{ $message }}</span>
        @enderror

        <label for="id_entidad">Seleccionar Entidad</label>
        <select name="id_entidad" id="id_entidad">
            <option value="">Seleccionar...</option>
        </select>
        @error('id_entidad')
            <span class="error">{{ $message }}</span>
        @enderror

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $municipio->nombre) }}" placeholder="Ingresa el nombre">
        @error('nombre')
            <span class="error">{{ $message }}</span>
        @enderror

        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="1" {{ old('status', $municipio->status) == 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ old('status', $municipio->status) == 0 ? 'selected' : '' }}>Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror

        <input type="submit" value="Actualizar Municipio">
    </form>

    <a href="{{ route('municipios.index') }}" class="button">Regresar</a>
</div>
</body>
</html>