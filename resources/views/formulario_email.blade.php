@extends('template.master')
@section('contenido')

  <div class="jumbotron">
    <h1>Enviar Correo electrónico</h1>
  </div>

  <div class="ourstory">
    <div class="container">
      <div class="col-md-10 col-md-offset-1">


<form method="POST" action="{!! asset('enviar_correo') !!}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <label id="destinatario" >Para: </label>
    <input type="text" name="destinatario" id="destinatario" placeholder="Ingresa la dirección de destino">

    <br />
    <br />

    <label id="asunto" >Asunto:</label>
    <input type="text" name="asunto" id="asunto" placeholder="Ingresa el asunto">

    <br />
    <br />

    <label id="contenido_mail" >Contenido:</label>
    <br />
    <textarea name="contenido_mail" id="contenido_mail" rows="10" cols="70" placeholder="Ingresa el contenido_mail"></textarea>

    <br />
    <br />
    <input type="submit" name="" value="Enviar Correo" class="btn btn-primary btn-lg">
</form>

    </div>
    </div>
    </div>
  <br /><br />
  <br />
    <a href="{!! asset('index') !!}" class="btn btn-primary btn-lg">REGRESAR A WELCOME</a>

@endsection()
