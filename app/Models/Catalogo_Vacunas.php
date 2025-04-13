<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_Vacunas extends Model
{
    protected $table = 'catalogo_vacunas';
    protected $fillable = ['nombre', 'status'];
}
