<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refugios extends Model
{
    protected $table = 'refugios';
    protected $fillable = [
        'nombre',
        'calle',
        'numero_exterior',
        'numero_interior',
        'codigo_postal',
        'colonia',
        'id_municipio',
        'id_usuario',
        'status'
    ];

    public function municipios()
    {
        return $this->belongsTo(Municipios::class, 'id_municipio', 'id');
    }

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario', 'id');
    }
}
