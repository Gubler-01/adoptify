<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $fillable = [
        'nombre',
        'ap_pat',
        'ap_mat',
        'username',
        'password',
        'email',
        'telefono',
        'genero',
        'fecha_nacimiento',
        'id_rol',
        'id_municipio',
        'status'
    ];

    public function roles_usuario()
    {
        return $this->belongsTo(Roles_Usuarios::class, 'id_rol', 'id');
    }

    public function municipios()
    {
        return $this->belongsTo(Municipios::class, 'id_municipio', 'id');
    }
}
