@extends('template.master')
@section('contenido')

  <div class="jumbotron">
    <h1>Mensaje</h1>
  </div>

  <div class="ourstory">
    <div class="container">
      <div class="col-md-10 col-md-offset-1">

    	<div class="section-title">
          <h2>Mensaje</h2>
            @if($var === '1')
                <div class="alert alert-success">
                {!! $msj !!}
                </div>
            @else
                <div class="alert alert-danger">
                {!! $msj !!}
                </div>
            @endif
            <a class="btn btn-outline btn-primary btn-lg  pull-right" href="{!! asset($ruta_boton) !!}">{!! $mensaje_boton !!}</a>
        </div>


    </div>
    </div>
    </div>
  <br /><br />
  <br />
    <a href="{!! asset('index') !!}" class="btn btn-primary btn-lg">REGRESAR A WELCOME</a>

@endsection()
