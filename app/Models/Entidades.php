<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entidades extends Model
{
    protected $table = 'entidades';
    protected $fillable = ['nombre', 'id_pais', 'status'];

    public function paises()
    {
        return $this->belongsTo(Paises::class, 'id_pais', 'id');
    }
}
