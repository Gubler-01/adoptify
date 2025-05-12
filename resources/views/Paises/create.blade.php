<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear paises</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Crear pais</h1>
    <form method="POST" action="{!! asset('paises') !!}">
        @csrf
        <label for="nombre">Nombre del pais</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ingresa el nombre del pais">
        @error('nombre')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="clave">Clave del pais</label>
        <input type="text" name="clave" id="clave" value="{{ old('clave') }}" placeholder="Ingresa la clave del pais">
        @error('clave')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status del pais</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Pais">
    </form>
    <br />
    <a href="{!! asset('paises') !!}" class="button">Regresar</a>
</div>
</body>
</html>