<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear solicitud de adopción</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Crear solicitud de adopción</h1>
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{!! asset('solicitudes-adopcion') !!}">
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
        <label for="id_adoptante">Seleccionar Adoptante</label>
        <select name="id_adoptante" id="id_adoptante">
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('id_adoptante') == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre }} {{ $usuario->ap_pat }} {{ $usuario->ap_mat }}</option>
            @endforeach
        </select>
        @error('id_adoptante')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="fecha_solicitud">Fecha de Solicitud</label>
        <input type="date" name="fecha_solicitud" id="fecha_solicitud" value="{{ old('fecha_solicitud') }}">
        @error('fecha_solicitud')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label>Hora de Solicitud</label>
        <select name="hora_solicitud" id="hora_solicitud">
            @for($i = 0; $i <= 23; $i++)
                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old('hora_solicitud') == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
            @endfor
        </select>
        :
        <select name="minuto_solicitud" id="minuto_solicitud">
            @foreach([0, 15, 30, 45] as $minuto)
                <option value="{{ str_pad($minuto, 2, '0', STR_PAD_LEFT) }}" {{ old('minuto_solicitud') == str_pad($minuto, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ str_pad($minuto, 2, '0', STR_PAD_LEFT) }}</option>
            @endforeach
        </select>
        @error('hora_solicitud')
            <span class="error">{{ $message }}</span>
        @enderror
        @error('minuto_solicitud')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="estado">Status de Adopción</label>
        <select name="estado" id="estado">
            <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Aprobada" {{ old('estado') == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
            <option value="Rechazada" {{ old('estado') == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
        </select>
        @error('estado')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="status">Status de la solicitud</label>
        <select name="status" id="status">
            <option value="1" selected>Activo</option>
            <option value="0">Baja</option>
        </select>
        @error('status')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <input type="submit" value="Guardar Solicitud">
    </form>
    <br />
    <a href="{!! asset('solicitudes-adopcion') !!}" class="button">Regresar</a>
</div>
</body>
</html>