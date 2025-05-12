<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear datos de empresa</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Crear datos de empresa</h1>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{!! asset('datos-empresa') !!}">
        @csrf
        <label for="id_usu_up">Seleccionar Usuario Responsable</label>
        <select name="id_usu_up" id="id_usu_up">
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('id_usu_up') == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre }} {{ $usuario->ap_pat }} {{ $usuario->ap_mat }}</option>
            @endforeach
        </select>
        @error('id_usu_up')
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
        <label for="mision">Misión</label>
        <textarea name="mision" id="mision" placeholder="Ingresa la misión de la empresa">{{ old('mision') }}</textarea>
        @error('mision')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="valores">Valores</label>
        <textarea name="valores" id="valores" placeholder="Ingresa los valores de la empresa">{{ old('valores') }}</textarea>
        @error('valores')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" placeholder="Ingresa el teléfono">
        @error('telefono')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="correo">Correo</label>
        <input type="email" name="correo" id="correo" value="{{ old('correo') }}" placeholder="Ingresa el correo">
        @error('correo')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="sitio_web">Sitio Web</label>
        <input type="text" name="sitio_web" id="sitio_web" value="{{ old('sitio_web') }}" placeholder="Ingresa el sitio web (opcional)">
        @error('sitio_web')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="latitud">Latitud</label>
        <input type="number" step="0.00000001" name="latitud" id="latitud" value="{{ old('latitud') }}" placeholder="Ingresa la latitud (opcional)">
        @error('latitud')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="longitud">Longitud</label>
        <input type="number" step="0.00000001" name="longitud" id="longitud" value="{{ old('longitud') }}" placeholder="Ingresa la longitud (opcional)">
        @error('longitud')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="facebook">Facebook</label>
        <input type="text" name="facebook" id="facebook" value="{{ old('facebook') }}" placeholder="Ingresa la URL de Facebook (opcional)">
        @error('facebook')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="x">X</label>
        <input type="text" name="x" id="x" value="{{ old('x') }}" placeholder="Ingresa la URL de X (opcional)">
        @error('x')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="instagram">Instagram</label>
        <input type="text" name="instagram" id="instagram" value="{{ old('instagram') }}" placeholder="Ingresa la URL de Instagram (opcional)">
        @error('instagram')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Datos de Empresa">
    </form>
    <br />
    <a href="{!! asset('datos-empresa') !!}" class="button">Regresar</a>
</div>
</body>
</html>