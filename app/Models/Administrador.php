<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use Notifiable;

    protected $table = 'administradores';

    protected $fillable = [
        'nombre',
        'user',
        'password',
        'activo',
        'roles_id',
        'usercreacion'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function Rol()
    {
        return $this->belongsTo(Rol::class , 'roles_id');
    }
}
