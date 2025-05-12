<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Entidad</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Crear Entidad</h1>
    <form method="POST" action="{!! asset('entidades') !!}">
        @csrf
        <label for="id_pais">Seleccionar pais</label>
        <select name="id_pais" id="id_pais">
            @foreach($paises as $pais)
                <option value="{{ $pais->id }}" {{ old('id_pais') == $pais->id ? 'selected' : '' }}>{{ $pais->nombre }}</option>
            @endforeach
        </select>
        @error('id_pais')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="nombre">Nombre de la entidad</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ingresa el nombre de la entidad">
        @error('nombre')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status de la entidad</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Entidad">
    </form>
</div>
</body>
</html>