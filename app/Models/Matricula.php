<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = "matriculas";

    protected $fillable = [
        'semestre_inicial',
        'usercreacion'
    ];
}
