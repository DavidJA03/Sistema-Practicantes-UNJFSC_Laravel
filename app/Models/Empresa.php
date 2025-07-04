<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JefeInmediato;
use App\Models\Practica;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'practicas_id',
        'nombre',
        'ruc',
        'razon_social',
        'direccion',
        'telefono',
        'correo',
        'web',
        'estado'
    ];

    public function practicas()
    {
        return $this->belongsTo(Practica::class, 'practicas_id','id');
    }
}
