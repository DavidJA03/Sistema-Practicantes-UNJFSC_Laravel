<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps = false; 
    use HasFactory;

    protected $table = 'personas';
    protected $fillable = [
        'codigo',
        'dni',
        'nombres',
        'apellidos',
        'celular',
        'sexo', 
        'ruta_foto',
        'correo_inst',
        'departamento',
        'provincia',
        'distrito',
        'usuario_id',
        'rol_id',
        'date_create',
        'date_update',
        'estado',
        'id_escuela'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function rol()
    {
        return $this->belongsTo(type_users::class);
    }
    public function matricula()
    {
        return $this->hasOne(Matricula::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'persona_id'); 
    }
    public function practica()
    {
        return $this->hasOne(Practica::class, 'estudiante_id','id');
    }
    public function gruposComoDocente()
    {
        return $this->hasMany(grupos_practica::class, 'id_docente');
    }

    public function gruposComoEstudiante()
    {
        return $this->hasMany(grupo_estudiante::class, 'id_estudiante');
    }
    public function gruposEstudiante()
    {
        return $this->hasOne(grupo_estudiante::class, 'id_estudiante');
    }

    public function gruposComoSupervisor()
    {
        return $this->hasMany(grupo_estudiante::class, 'id_supervisor');
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'id_escuela'); // o el campo que tengas como FK
    }
    public function type_user() {
        return $this->belongsTo(type_users::class, 'rol_id');
    }

    public function evaluacione()
    {
        return $this->hasOne(Evaluacione::class, 'alumno_id');
    }


    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }

    protected static function booted()
    {
        static::deleting(function ($persona) {
            if ($persona->user) {
                $persona->user->delete();
            }
        });
    }

    public function grupo_estudiante()
    {
        return $this->hasOne(grupo_estudiante::class, 'id_estudiante');
    }
    public function grupo_estudiantes2()
{
    return $this->hasMany(\App\Models\grupo_estudiante::class, 'id_supervisor', 'id');
}

        public function grupos_practica()
    {
        return $this->hasMany(\App\Models\grupos_practica::class, 'id_docente', 'id');
    }


}