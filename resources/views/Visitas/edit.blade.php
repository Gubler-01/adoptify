<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar visita</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Editar visita</h1>
    <form method="POST" action="{!! asset('visitas/' . $visita->id) !!}">
        @csrf
        @method('PATCH')
        <label for="id_solicitud">Seleccionar Solicitud</label>
        <select name="id_solicitud" id="id_solicitud">
            @foreach($solicitudes as $solicitud)
                <option value="{{ $solicitud->id }}" {{ old('id_solicitud', $visita->id_solicitud) == $solicitud->id ? 'selected' : '' }}>
                    Solicitud #{{ $solicitud->id }} - Animal: {{ $solicitud->animales->nombre }} - Adoptante: {{ $solicitud->usuarios->nombre }} {{ $solicitud->usuarios->ap_pat }} {{ $solicitud->usuarios->ap_mat }}
                </option>
            @endforeach
        </select>
        @error('id_solicitud')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="fecha_visita">Fecha de Visita</label>
        <input type="datetime-local" name="fecha_visita" id="fecha_visita" value="{{ old('fecha_visita', $visita->fecha_visita) }}">
        @error('fecha_visita')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="comentarios">Comentarios</label>
        <textarea name="comentarios" id="comentarios" placeholder="Ingresa comentarios sobre la visita">{{ old('comentarios', $visita->comentarios) }}</textarea>
        @error('comentarios')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status de la visita</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Visita">
    </form>
    <br />
    <a href="{!! asset('visitas') !!}" class="button">Regresar</a>
</div>
</body>
</html>