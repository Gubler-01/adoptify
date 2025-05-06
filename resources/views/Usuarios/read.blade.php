<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>Detalle de usuario</h1>
    <div class="detail">
        <p><strong>Nombre:</strong> {{ $user->nombre }} {{ $user->ap_pat }} {{ $user->ap_mat }}</p>
        <p><strong>Rol:</strong> {{ $user->roles_usuario->nombre }}</p>
        <p><strong>País:</strong> {{ $user->municipios->entidades->paises->nombre }}</p>
        <p><strong>Entidad:</strong> {{ $user->municipios->entidades->nombre }}</p>
        <p><strong>Municipio:</strong> {{ $user->municipios->nombre }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Teléfono:</strong> {{ $user->telefono }}</p>
        <p><strong>Género:</strong> {{ $user->genero == 'M' ? 'Masculino' : ($user->genero == 'F' ? 'Femenino' : 'Otro') }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $user->fecha_nacimiento }}</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Password:</strong> {{ $user->password }}</p>
        <p><strong>Status:</strong> {{ $user->status ? 'Activo' : 'Baja' }}</p>
    </div>
    <br />
    <a href="{!! asset('usuarios') !!}" class="button">REGRESAR A LOS USUARIOS</a>
</div>
</body>
</html>