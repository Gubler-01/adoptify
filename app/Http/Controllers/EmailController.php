<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function form_enviar_correo()
    {
        return view("formulario_email");
    }

    public function enviar_correo(Request $request)
    {

        $destinatario=$request->input("destinatario");
        $asunto=$request->input("asunto");
        $contenido=$request->input("contenido_mail");


        $data = array('contenido' => $contenido);
        $r = Mail::send('plantilla_correo', $data, function ($message) use ($asunto,$destinatario) {
        $message->from('l20281440@toluca.tecnm.mx', 'Adoptify Oficial');
        $message->to($destinatario)->subject($asunto);
        });


        if(!$r){
            return view("plantillamensaje")
            ->with('var','2')
            ->with('msj','Error al enviar el Correo')
            ->with('ruta_boton','menu')
            ->with('mensaje_boton','WELCOME :(');
        }else{
            return view("plantillamensaje")
            ->with('var','1')
            ->with('msj','Correo enviado correctamente')
            ->with('ruta_boton','menu')
            ->with('mensaje_boton','WELCOME OK');

        }

    }
}
