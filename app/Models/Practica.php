<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    use HasFactory;
    protected $table = 'practicas';

    protected $fillable = [
        'estudiante_id',
        'estado_proceso',
        'tipo_practica',
        'ruta_fut',
        'ruta_carta_aceptacion',
        'ruta_carta_presentacion',
        'ruta_plan_actividades',
        'ruta_constancia_cumplimiento',
        'ruta_registro_actividades',
        'ruta_control_actividades',
        'ruta_informe_final',
        'estado'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'estudiante_id');
    }
    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'practicas_id','id');
    }
    public function jefeInmediato()
    {
        return $this->hasOne(JefeInmediato::class, 'practicas_id','id');
    }

}
