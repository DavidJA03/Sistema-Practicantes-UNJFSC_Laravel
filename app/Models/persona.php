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
        'correo_inst',
        'departamento',
        'provincia',
        'distrito',
        'usuario_id',
        'rol_id',
        'date_create',
        'date_update',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function rol()
    {
        return $this->belongsTo(TypeUser::class);
    }
    public function matricula()
    {
        return $this->hasOne(Matricula::class);
    }

}