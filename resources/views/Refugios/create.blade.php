<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear refugio</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function cambiar_combo_entidad(id_pais) {
            $("#id_entidad").empty();
            $("#municipio_id").empty();
            var ruta = "{{ asset('combo_entidad_muni') }}/" + id_pais;
            $.ajax({
                type: 'GET',
                url: ruta,
                success: function(data) {
                    var entidades = data;
                    $('#id_entidad').append('<option value="0">Seleccionar...</option>');
                    for (var i = 0; i < entidades.length; i++) {
                        $('#id_entidad').append('<option value="' + entidades[i].id + '">' + entidades[i].nombre + '</option>');
                    }
                },
                error: function() {
                    alert('Error al cargar las entidades.');
                }
            });
        }

        function cambiar_combo_municipios(id_entidad) {
            $("#municipio_id").empty();
            var ruta = "{{ asset('combo_municipio') }}/" + id_entidad;
            $.ajax({
                type: 'GET',
                url: ruta,
                success: function(data) {
                    var municipios = data;
                    $('#municipio_id').append('<option value="0">Seleccionar...</option>');
                    for (var i = 0; i < municipios.length; i++) {
                        $('#municipio_id').append('<option value="' + municipios[i].id + '">' + municipios[i].nombre + '</option>');
                    }
                },
                error: function() {
                    alert('Error al cargar los municipios.');
                }
            });
        }
    </script>
</head>
<body>
<div class="container">
    <h1>Crear refugio</h1>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('refugios.store') }}">
        @csrf
        <label for="nombre">Nombre del refugio</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ingresa el nombre del refugio">
        @error('nombre')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="calle">Calle</label>
        <input type="text" name="calle" id="calle" value="{{ old('calle') }}" placeholder="Ingresa la calle">
        @error('calle')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="numero_exterior">Número Exterior</label>
        <input type="text" name="numero_exterior" id="numero_exterior" value="{{ old('numero_exterior') }}" placeholder="Ingresa el número exterior">
        @error('numero_exterior')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="numero_interior">Número Interior</label>
        <input type="text" name="numero_interior" id="numero_interior" value="{{ old('numero_interior') }}" placeholder="Ingresa el número interior (opcional)">
        @error('numero_interior')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="codigo_postal">Código Postal</label>
        <input type="text" name="codigo_postal" id="codigo_postal" value="{{ old('codigo_postal') }}" placeholder="Ingresa el código postal">
        @error('codigo_postal')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="colonia">Colonia</label>
        <input type="text" name="colonia" id="colonia" value="{{ old('colonia') }}" placeholder="Ingresa la colonia">
        @error('colonia')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_pais">Seleccionar País</label>
        <select name="id_pais" id="id_pais" onchange="cambiar_combo_entidad(this.value);">
            <option value="0" {{ old('id_pais') == 0 ? 'selected' : '' }}>Seleccionar...</option>
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}" {{ old('id_pais') == $pais->id ? 'selected' : '' }}>{{ $pais->nombre }}</option>
            @endforeach
        </select>
        @error('id_pais')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_entidad">Seleccionar Entidad</label>
        <select name="id_entidad" id="id_entidad" onchange="cambiar_combo_municipios(this.value);">
            <option value="0" {{ old('id_entidad') == 0 ? 'selected' : '' }}>Seleccionar...</option>
        </select>
        @error('id_entidad')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="municipio_id">Seleccionar Municipio</label>
        <select name="municipio_id" id="municipio_id">
            <option value="0" {{ old('municipio_id') == 0 ? 'selected' : '' }}>Seleccionar...</option>
        </select>
        @error('municipio_id')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_usuario">Seleccionar Usuario</label>
        <select name="id_usuario" id="id_usuario">
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('id_usuario') == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre }} {{ $usuario->ap_pat }} {{ $usuario->ap_mat }}</option>
            @endforeach
        </select>
        @error('id_usuario')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status del refugio</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Refugio">
    </form>
    <br />
    <a href="{!! asset('refugios') !!}" class="button">Regresar</a>
</div>
</body>
</html>