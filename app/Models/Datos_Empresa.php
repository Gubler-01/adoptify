<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datos_Empresa extends Model
{
    protected $table = 'datos_empresa';
    protected $fillable = [
        'id_usu_up',
        'calle',
        'numero_exterior',
        'numero_interior',
        'codigo_postal',
        'colonia',
        'mision',
        'valores',
        'telefono',
        'correo',
        'latitud',
        'longitud',
        'status',
        'facebook',
        'x',
        'instagram'
    ];

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'id_usu_up', 'id');
    }
}
