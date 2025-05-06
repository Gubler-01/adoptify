<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear adopción</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Crear adopción</h1>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{!! asset('adopciones') !!}">
        @csrf
        <label for="id_solicitud">Seleccionar Solicitud</label>
        <select name="id_solicitud" id="id_solicitud">
            @foreach($solicitudes as $solicitud)
                <option value="{{ $solicitud->id }}" {{ old('id_solicitud') == $solicitud->id ? 'selected' : '' }}>
                    Solicitud #{{ $solicitud->id }} - Animal: {{ $solicitud->animales->nombre }} - Adoptante: {{ $solicitud->usuarios->nombre }} {{ $solicitud->usuarios->ap_pat }} {{ $solicitud->usuarios->ap_mat }}
                </option>
            @endforeach
        </select>
        @error('id_solicitud')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="fecha_adopcion">Fecha de Adopción</label>
        <input type="datetime-local" name="fecha_adopcion" id="fecha_adopcion" value="{{ old('fecha_adopcion') }}">
        @error('fecha_adopcion')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="notas">Notas</label>
        <textarea name="notas" id="notas" placeholder="Ingresa notas sobre la adopción">{{ old('notas') }}</textarea>
        @error('notas')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status de la adopción</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Adopción">
    </form>
    <br />
    <a href="{!! asset('adopciones') !!}" class="button">Regresar</a>
</div>
</body>
</html>