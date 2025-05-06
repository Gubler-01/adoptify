<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar refugio</title>
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
                        $('#id_entidad').append('<option value="' + entidades[i].id + '"' + (entidades[i].id == {{ old('id_entidad', $refugio->municipios->entidades->id) }} ? ' selected' : '') + '>' + entidades[i].nombre + '</option>');
                    }
                    if (id_pais == {{ $refugio->municipios->entidades->paises->id }}) {
                        cambiar_combo_municipios({{ old('id_entidad', $refugio->municipios->entidades->id) }});
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
                        $('#municipio_id').append('<option value="' + municipios[i].id + '"' + (municipios[i].id == {{ old('municipio_id', $refugio->municipios->id) }} ? ' selected' : '') + '>' + municipios[i].nombre + '</option>');
                    }
                },
                error: function() {
                    alert('Error al cargar los municipios.');
                }
            });
        }

        $(document).ready(function() {
            cambiar_combo_entidad({{ $refugio->municipios->entidades->paises->id }});
        });
    </script>
</head>
<body>
<div class="container">
    <h1>Editar refugio</h1>
    <form method="POST" action="{!! asset('refugios/' . $refugio->id) !!}">
        @csrf
        @method('PATCH')
        <label for="nombre">Nombre del refugio</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $refugio->nombre) }}" placeholder="Ingresa el nombre del refugio">
        @error('nombre')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="calle">Calle</label>
        <input type="text" name="calle" id="calle" value="{{ old('calle', $refugio->calle) }}" placeholder="Ingresa la calle">
        @error('calle')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="numero_exterior">Número Exterior</label>
        <input type="text" name="numero_exterior" id="numero_exterior" value="{{ old('numero_exterior', $refugio->numero_exterior) }}" placeholder="Ingresa el número exterior">
        @error('numero_exterior')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="numero_interior">Número Interior</label>
        <input type="text" name="numero_interior" id="numero_interior" value="{{ old('numero_interior', $refugio->numero_interior) }}" placeholder="Ingresa el número interior (opcional)">
        @error('numero_interior')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="codigo_postal">Código Postal</label>
        <input type="text" name="codigo_postal" id="codigo_postal" value="{{ old('codigo_postal', $refugio->codigo_postal) }}" placeholder="Ingresa el código postal">
        @error('codigo_postal')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="colonia">Colonia</label>
        <input type="text" name="colonia" id="colonia" value="{{ old('colonia', $refugio->colonia) }}" placeholder="Ingresa la colonia">
        @error('colonia')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_pais">Seleccionar País</label>
        <select name="id_pais" id="id_pais" onchange="cambiar_combo_entidad(this.value);">
            <option value="{{ $refugio->municipios->entidades->paises->id }}">{{ $refugio->municipios->entidades->paises->nombre }}</option>
            @foreach($paises as $pais)
                @if($pais->id != $refugio->municipios->entidades->paises->id)
                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                @endif
            @endforeach
        </select>
        @error('id_pais')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_entidad">Seleccionar Entidad</label>
        <select name="id_entidad" id="id_entidad" onchange="cambiar_combo_municipios(this.value);">
            <option value="0">Seleccionar...</option>
        </select>
        @error('id_entidad')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="municipio_id">Seleccionar Municipio</label>
        <select name="municipio_id" id="municipio_id">
            <option value="0">Seleccionar...</option>
        </select>
        @error('municipio_id')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_usuario">Seleccionar Usuario</label>
        <select name="id_usuario" id="id_usuario">
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('id_usuario', $refugio->id_usuario) == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre }} {{ $usuario->ap_pat }} {{ $usuario->ap_mat }}</option>
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