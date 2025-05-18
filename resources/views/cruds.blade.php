@extends('template.master')
@section('contenido')

<style>
    .button-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Space between buttons */
        justify-content: center; /* Center the buttons */
        padding: 20px;
    }

    .button-container a {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .button-container a:hover {
        background-color: #0056b3;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .button-container a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="button-container">
    <a href="{!! asset('paises') !!}" class="btn btn-primary">Países</a>
    <a href="{!! asset('entidades') !!}" class="btn btn-primary">Entidades</a>
    <a href="{!! asset('municipios') !!}" class="btn btn-primary">Municipios</a>
    <a href="{!! asset('usuarios') !!}" class="btn btn-primary">Usuarios</a>
    <a href="{!! asset('refugios') !!}" class="btn btn-primary">Refugios</a>
    <a href="{!! asset('animales') !!}" class="btn btn-primary">Animales</a>
    <a href="{!! asset('solicitudes-adopcion') !!}" class="btn btn-primary">Solicitudes de adopciones</a>
    <a href="{!! asset('adopciones') !!}" class="btn btn-primary">Adopciones</a>
    <a href="{!! asset('visitas') !!}" class="btn btn-primary">Visitas</a>
    <a href="{!! asset('seguimientos') !!}" class="btn btn-primary">Seguimientos</a>
    <a href="{!! asset('vacunas') !!}" class="btn btn-primary">Vacunas</a>
    <a href="{!! asset('fotos') !!}" class="btn btn-primary">Fotos</a>
    <a href="{!! asset('ejemplos_ajax') !!}" class="btn btn-primary">Ejemplos AJAX</a>
    <a href="{!! asset('genera_pdf') !!}" class="btn btn-primary">Generar Reportes</a>
    <a href="{!! asset('form_enviar_correo') !!}" class="btn btn-primary">Enviar Correo Electrónico</a>
    <a href="{!! asset('datos-empresa') !!}" class="btn btn-primary">Datos empresa</a>
</div>

@endsection