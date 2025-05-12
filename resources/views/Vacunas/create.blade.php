<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear vacuna</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Crear vacuna</h1>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{!! asset('vacunas') !!}">
        @csrf
        <label for="id_animal">Seleccionar Animal</label>
        <select name="id_animal" id="id_animal">
            @foreach($animales as $animal)
                <option value="{{ $animal->id }}" {{ old('id_animal') == $animal->id ? 'selected' : '' }}>{{ $animal->nombre }}</option>
            @endforeach
        </select>
        @error('id_animal')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="id_vacuna">Seleccionar Vacuna</label>
        <select name="id_vacuna" id="id_vacuna">
            @foreach($catalogo_vacunas as $vacuna)
                <option value="{{ $vacuna->id }}" {{ old('id_vacuna') == $vacuna->id ? 'selected' : '' }}>{{ $vacuna->nombre }}</option>
            @endforeach
        </select>
        @error('id_vacuna')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="fecha_aplicacion">Fecha de Aplicación</label>
        <input type="datetime-local" name="fecha_aplicacion" id="fecha_aplicacion" value="{{ old('fecha_aplicacion') }}">
        @error('fecha_aplicacion')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status de la vacuna</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Vacuna">
    </form>
    <br />
    <a href="{!! asset('vacunas') !!}" class="button">Regresar</a>
</div>
</body>
</html>