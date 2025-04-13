<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adopciones extends Model
{
    protected $table = 'adopciones';
    protected $fillable = [
        'id_solicitud',
        'fecha_adopcion',
        'notas',
        'status'
    ];

    public function solicitudes_adopcion()
    {
        return $this->belongsTo(Solicitudes_Adopciones::class, 'id_solicitud', 'id');
    }
}
