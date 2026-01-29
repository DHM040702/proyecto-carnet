<?php

namespace App\Models;

use Faker\Provider\Person;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = "estudiantes";

    protected $fillable = [
        'codigo_estudiante',
        'fecha_creacion',
        'correo',
        'persona_id',
        'escuela_id',
        'matricula_id',
        'usercreacion'
    ];

    public function Persona()
    {
        return $this->belongsTo(Persona::class , 'persona_id');
    }

    public function Escuela(){
        return $this->belongsTo(Escuela::class , 'escuela_id');
    }

    public function Matricula()
    {
        return $this->belongsTo(Matricula::class , 'matricula_id');
    }
}
