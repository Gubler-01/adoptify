<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Foto</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Crear Foto</h1>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{!! asset('fotos') !!}" enctype="multipart/form-data">
        @csrf
        <label for="id_animal">Animal</label>
        <select name="id_animal" id="id_animal">
            <option value="0" {{ old('id_animal') == 0 ? 'selected' : '' }}>Seleccionar...</option>
            @foreach($animales as $animal)
                <option value="{{ $animal->id }}" {{ old('id_animal') == $animal->id ? 'selected' : '' }}>{{ $animal->nombre }}</option>
            @endforeach
        </select>
        @error('id_animal')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="foto">Foto</label>
        <input type="file" name="foto" id="foto" accept="image/*" />
        @error('foto')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="fecha_subida">Fecha de Subida</label>
        <input type="datetime-local" name="fecha_subida" id="fecha_subida" value="{{ old('fecha_subida') }}">
        @error('fecha_subida')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status de la foto</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Foto">
    </form>
    <br />
    <a href="{!! asset('fotos') !!}" class="button">Regresar</a>
</div>
</body>
</html>