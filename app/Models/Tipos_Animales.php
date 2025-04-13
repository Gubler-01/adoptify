<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipos_Animales extends Model
{
    protected $table = 'tipos_animales';
    protected $fillable = ['nombre', 'status'];
}
