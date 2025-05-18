<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuarios extends Authenticatable
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles_usuario()
    {
        return $this->belongsTo(Roles_Usuarios::class, 'id_rol', 'id');
    }

    public function municipios()
    {
        return $this->belongsTo(Municipios::class, 'id_municipio', 'id');
    }
}
