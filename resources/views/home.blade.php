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

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
