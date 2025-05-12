<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar seguimiento</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Editar seguimiento</h1>
    <form method="POST" action="{!! asset('seguimientos/' . $seguimiento->id) !!}">
        @csrf
        @method('PATCH')
        <label for="id_adopcion">Seleccionar Adopción</label>
        <select name="id_adopcion" id="id_adopcion">
            @foreach($adopciones as $adopcion)
                <option value="{{ $adopcion->id }}" {{ old('id_adopcion', $seguimiento->id_adopcion) == $adopcion->id ? 'selected' : '' }}>
                    Adopción #{{ $adopcion->id }} - Solicitud #{{ $adopcion->id_solicitud }} - Animal: {{ $adopcion->solicitudes_adopcion->animales->nombre }} - Adoptante: {{ $adopcion->solicitudes_adopcion->usuarios->nombre }} {{ $adopcion->solicitudes_adopcion->usuarios->ap_pat }} {{ $adopcion->solicitudes_adopcion->usuarios->ap_mat }}
                </option>
            @endforeach
        </select>
        @error('id_adopcion')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="fecha_seguimiento">Fecha de Seguimiento</label>
        <input type="datetime-local" name="fecha_seguimiento" id="fecha_seguimiento" value="{{ old('fecha_seguimiento', $seguimiento->fecha_seguimiento) }}">
        @error('fecha_seguimiento')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="observaciones">Observaciones</label>
        <textarea name="observaciones" id="observaciones" placeholder="Ingresa observaciones sobre el seguimiento">{{ old('observaciones', $seguimiento->observaciones) }}</textarea>
        @error('observaciones')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status del seguimiento</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Seguimiento">
    </form>
    <br />
    <a href="{!! asset('seguimientos') !!}" class="button">Regresar</a>
</div>
</body>
</html>