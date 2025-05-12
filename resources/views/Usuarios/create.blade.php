<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear usuario</title>
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
    <h1>Crear usuario</h1>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ingresa el nombre">
        @error('nombre')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="ap_pat">Apellido Paterno</label>
        <input type="text" name="ap_pat" id="ap_pat" value="{{ old('ap_pat') }}" placeholder="Ingresa el apellido paterno">
        @error('ap_pat')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="ap_mat">Apellido Materno</label>
        <input type="text" name="ap_mat" id="ap_mat" value="{{ old('ap_mat') }}" placeholder="Ingresa el apellido materno (opcional)">
        @error('ap_mat')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Ingresa el username">
        @error('username')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Ingresa la contraseña">
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Ingresa el email">
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" placeholder="Ingresa el teléfono (opcional)">
        @error('telefono')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="genero">Género</label>
        <select name="genero" id="genero">
            <option value="" {{ old('genero') == '' ? 'selected' : '' }}>Seleccionar...</option>
            <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
            <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
            <option value="O" {{ old('genero') == 'O' ? 'selected' : '' }}>Otro</option>
        </select>
        @error('genero')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
        @error('fecha_nacimiento')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_rol">Seleccionar Rol</label>
        <select name="id_rol" id="id_rol">
            @foreach($tipos_usuario as $tipo)
                <option value="{{ $tipo->id }}" {{ old('id_rol') == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
            @endforeach
        </select>
        @error('id_rol')
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
        <label for="status">Status del usuario</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Usuario">
    </form>
    <br />
    <a href="{!! asset('usuarios') !!}" class="button">Regresar</a>
</div>
</body>
</html>