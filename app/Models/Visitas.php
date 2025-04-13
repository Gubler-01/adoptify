<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitas extends Model
{
    protected $table = 'visitas';
    protected $fillable = [
        'id_solicitud',
        'fecha_visita',
        'comentarios',
        'status'
    ];

    public function solicitudes_adopcion()
    {
        return $this->belongsTo(Solicitudes_Adopciones::class, 'id_solicitud', 'id');
    }
}
