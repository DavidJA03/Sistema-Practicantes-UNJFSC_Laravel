<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupos_practica extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_docente',
        'id_semestre',
        'id_escuela',
        'nombre_grupo',
        'date_create',
        'estado',
    ];

    public function docente()
    {
        return $this->belongsTo(Persona::class, 'id_docente');
    }

    // Relación con estudiantes del grupo
    public function estudiantes()
    {
        return $this->hasMany(grupo_estudiante::class, 'id_grupo_practica');
    }
    public function semestre()
    {
        return $this->belongsTo(Semestre::class, 'id_semestre');
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'id_escuela');
    }
    public function grupoPractica()
    {
        return $this->belongsTo(grupos_practica::class);
    }

}
