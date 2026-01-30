<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $table ="semestres";

    protected $fillable = [
        'semestre',
        'fecha_inicio',
        'fecha_fin',
        'fecha_inicio_solicitud',
        'fecha_fin_solicitud',
        'usercreacion'
    ];
}
