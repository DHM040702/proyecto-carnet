<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'dni',
        'nombres',
        'apellido_pat',
        'apellido_mat',
        'telefono',
        'usercreacion'
    ];
}

