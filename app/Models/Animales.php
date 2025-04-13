<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animales extends Model
{
    protected $table = 'animales';
    protected $fillable = [
        'nombre',
        'edad',
        'raza',
        'id_tipo_animal',
        'id_refugio',
        'status'
    ];

    public function tipos_animales()
    {
        return $this->belongsTo(Tipos_Animales::class, 'id_tipo_animal', 'id');
    }

    public function refugios()
    {
        return $this->belongsTo(Refugios::class, 'id_refugio', 'id');
    }
}
