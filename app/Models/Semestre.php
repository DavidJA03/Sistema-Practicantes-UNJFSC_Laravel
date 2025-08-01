<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $table = 'semestres';

        protected $fillable = [
            'codigo',
            'ciclo',
            'user_create',
            'date_create',
            'estado',
        ];

        public $timestamps = false;
}
