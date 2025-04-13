<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles_Usuarios extends Model
{
    protected $table = 'roles_usuario';
    protected $fillable = ['nombre', 'status'];
}
