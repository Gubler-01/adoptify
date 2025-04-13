<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacunas extends Model
{
    protected $table = 'vacunas';
    protected $fillable = [
        'id_animal',
        'id_vacuna',
        'fecha_aplicacion',
        'status'
    ];

    public function animales()
    {
        return $this->belongsTo(Animales::class, 'id_animal', 'id');
    }

    public function catalogo_vacunas()
    {
        return $this->belongsTo(Catalogo_Vacunas::class, 'id_vacuna', 'id');
    }
}
