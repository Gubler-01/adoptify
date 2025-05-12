<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear animal</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Crear animal</h1>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{!! asset('animales') !!}">
        @csrf
        <label for="nombre">Nombre del animal</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ingresa el nombre del animal">
        @error('nombre')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="edad">Edad</label>
        <input type="number" name="edad" id="edad" value="{{ old('edad') }}" placeholder="Ingresa la edad del animal">
        @error('edad')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="raza">Raza</label>
        <input type="text" name="raza" id="raza" value="{{ old('raza') }}" placeholder="Ingresa la raza del animal">
        @error('raza')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_tipo_animal">Seleccionar Tipo de Animal</label>
        <select name="id_tipo_animal" id="id_tipo_animal">
            @foreach($tipos_animales as $tipo_animal)
                <option value="{{ $tipo_animal->id }}" {{ old('id_tipo_animal') == $tipo_animal->id ? 'selected' : '' }}>{{ $tipo_animal->nombre }}</option>
            @endforeach
        </select>
        @error('id_tipo_animal')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_refugio">Seleccionar Refugio</label>
        <select name="id_refugio" id="id_refugio">
            @foreach($refugios as $refugio)
                <option value="{{ $refugio->id }}" {{ old('id_refugio') == $refugio->id ? 'selected' : '' }}>{{ $refugio->nombre }}</option>
            @endforeach
        </select>
        @error('id_refugio')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status del animal</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Animal">
    </form>
    <br />
    <a href="{!! asset('animales') !!}" class="button">Regresar</a>
</div>
</body>
</html>