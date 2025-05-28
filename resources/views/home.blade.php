@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p>Nivel de usuario {{ Auth::user()->id_rol }}</p>
                    <p>Rol: 
                        @if(Auth::user()->id_rol == 1)
                            Administrador
                        @elseif(Auth::user()->id_rol == 2)
                            Refugio
                        @elseif(Auth::user()->id_rol == 3)
                            Adoptante
                        @else
                            Desconocido
                        @endif
                    </p>

                    <h1>Menu Principal</h1>
                    <ol>
                        @if(Auth::user()->id_rol == 1) <!-- Administrador -->
                            <li><a href="{!! asset('principal') !!}" class="btn btn-primary btn-lg">Pagina principal</a></li>

                        @elseif(Auth::user()->id_rol == 2) <!-- Refugio -->
                            <li><a href="{!! asset('animales') !!}" class="btn btn-primary">Animales</a></li>
                            <li><a href="{!! asset('genera_pdf') !!}" class="btn btn-primary">PDFs</a></li>
                            <li><a href="{!! asset('solicitudes-adopcion') !!}" class="btn btn-primary">Solicitudes de  adopción</a></li>
                            <li><a href="{!! asset('form_enviar_correo') !!}" class="btn btn-primary">Enviar Correo Electrónico</a></li>
                            <li><a href="{!! asset('genera_pdf') !!}" class="btn btn-primary">Generar Reportes</a></li>
                            <li><a href="{!! asset('form_enviar_correo') !!}" class="btn btn-primary">Enviar correo</a></li>
                            <li><a href="{!! asset('ejemplos_ajax') !!}" class="btn btn-primary">Consultar animales</a></li>
                            <li><a href="{!! asset('seguimientos') !!}" class="btn btn-primary">Seguimientos</a></li>
                            <li><a href="{!! asset('vacunas') !!}" class="btn btn-primary">Vacunas</a></li>

                        @elseif(Auth::user()->id_rol == 3) <!-- Adoptante -->
                            <li><a href="{!! asset('animales') !!}" class="btn btn-primary">Mascotas</a></li>
                            <li><a href="{!! asset('solicitudes-adopcion') !!}" class="btn btn-primary">Solicitud de adopción</a></li>
                            <li><a href="{!! asset('fotos') !!}" class="btn btn-primary">Fotos de Mascotas</a></li>
                            <li><a href="{!! asset('visitas') !!}" class="btn btn-primary">Solicitar Visita</a></li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection