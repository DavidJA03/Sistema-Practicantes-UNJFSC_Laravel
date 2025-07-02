<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JefeInmediato extends Model
{
    protected $table = 'jefe_inmediato';
    protected $fillable = [
        'nombres',
        'dni',
        'cargo',
        'area',
        'correo',
        'telefono',
        'web',
        'practicas_id',
        'estado'
    ];

    public function practica()
    {
        return $this->belongsTo(Practica::class, 'practicas_id');
    }
}
