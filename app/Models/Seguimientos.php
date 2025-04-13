<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimientos extends Model
{
    protected $table = 'seguimientos';
    protected $fillable = [
        'id_adopcion',
        'fecha_seguimiento',
        'observaciones',
        'status'
    ];

    public function adopciones()
    {
        return $this->belongsTo(Adopciones::class, 'id_adopcion', 'id');
    }
}
