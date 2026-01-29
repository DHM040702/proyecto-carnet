<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = [
        'numero_solicitud',
        'estudiante_id',
        'fecha_solicitud',
        'fecha_expedicion',
        'estados_id',
        'vouchers_id',
        'fotos_id',
        'semestres_id'
    ];

    public function Estados()
    {
        return $this->belongsTo(Estado::class , 'estados_id');
    }

    public function Voucher()
    {
        return $this->belongsTo(Voucher::class , 'vouchers_id');
    }

    public function Foto()
    {
        return $this->belongsTo(Foto::class , 'fotos_id');
    }

    public function Semestre()
    {
        return $this->belongsTo(Semestre::class , 'Semestres_id');
    }
}
