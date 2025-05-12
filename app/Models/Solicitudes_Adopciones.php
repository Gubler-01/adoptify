<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitudes_Adopciones extends Model
{
    protected $table = 'solicitudes_adopciones';
    protected $fillable = [
        'id_animal',
        'id_adoptante',
        'fecha_solicitud',
        'estado',
        'status'
    ];

    public function animales()
    {
        return $this->belongsTo(Animales::class, 'id_animal', 'id');
    }

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'id_adoptante', 'id');
    }
}
