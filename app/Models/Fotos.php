<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fotos extends Model
{
    protected $table = 'fotos';
    protected $fillable = [
        'id_animal',
        'url_foto',
        'fecha_subida',
        'status'
    ];

    public function animales()
    {
        return $this->belongsTo(Animales::class, 'id_animal', 'id');
    }
}
