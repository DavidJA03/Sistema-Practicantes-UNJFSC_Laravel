<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupo_estudiante extends Model
{
    use HasFactory;
    protected $table = 'grupo_estudiante';

    protected $fillable = [
    'id_supervisor',
    'id_estudiante',
    'id_grupo_practica',
    'estado'
    ];



    public function estudiante()
    {
        return $this->belongsTo(Persona::class, 'id_estudiante');
    }
 
    public function supervisor()
    {
        return $this->belongsTo(Persona::class, 'id_supervisor');
    }

    public function grupo()
    {
        return $this->belongsTo(grupos_practica::class, 'id_grupo_practica');
    }
}
