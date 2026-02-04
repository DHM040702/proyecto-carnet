<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;

    protected $table = 'escuelas';

    protected $fillable = [
        'escuela',
        'facultad_id',
        'usercreacion',
    ];

    public function Facultad()
    {
        return $this->belongsTo(Facultad::class, 'facultad_id');
    }
}
