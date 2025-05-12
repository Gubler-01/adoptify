<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Foto</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Editar Foto</h1>
    <h2>Foto actual:</h2>
    <img src="../../../storage/fotografias/{!! $foto->url_foto !!}" height="150px" />
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{!! asset('fotos/' . $foto->id) !!}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id_animal" value="{{ $foto->id_animal }}" />
        <br /><br />
        <label for="foto">Nueva Foto</label>
        <input type="file" name="foto" id="foto" accept="image/*" />
        @error('foto')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
        <label for="fecha_subida">Fecha de Subida</label>
        <input type="datetime-local" name="fecha_subida" id="fecha_subida" value="{{ old('fecha_subida', $foto->fecha_subida) }}">
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
        <input type="submit" value="Actualizar Foto">
    </form>
    <br />
    <a href="{!! asset('fotos') !!}" class="button">Regresar</a>
</div>
</body>
</html>