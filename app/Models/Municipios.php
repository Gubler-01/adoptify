<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = 'municipios';
    protected $fillable = ['nombre', 'id_entidad', 'status'];

    public function entidades()
    {
        return $this->belongsTo(Entidades::class, 'id_entidad', 'id');
    }
}
