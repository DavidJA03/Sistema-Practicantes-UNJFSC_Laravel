<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;

    public function facultad(){
        return $this->belongsTo(\App\Models\Facultade::class, 'facultad_id');
    }
    

    protected $fillable = ['name', 'facultad_id', 'user_create', 'date_create'];
}
