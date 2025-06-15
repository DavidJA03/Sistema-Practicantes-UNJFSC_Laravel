<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_users extends Model
{
    use HasFactory;

    protected $table = 'type_users';

    public $timestamps = false; // Si no usas created_at y updated_at

    protected $fillable = [
        'name', 'date_create', 'date_update', 'estado'
    ];

    public function personas()
    {
        return $this->hasMany(Persona::class);
    }
}
