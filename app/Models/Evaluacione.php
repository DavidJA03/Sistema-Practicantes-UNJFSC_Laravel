<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacione extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'alumno_id',
        'anexo_7',
        'anexo_8',
        'pregunta_1',
        'pregunta_2',
        'pregunta_3',
        'pregunta_4',
        'pregunta_5',
        'user_create',
        'user_update',
        'date_create',
        'date_update',
        'estado',
];

    protected $casts = [
        
    ];

    public function alumno()
    {
        return $this->belongsTo(Persona::class, 'alumno_id');
    }
}
