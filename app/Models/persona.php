<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con Rol (uno a uno o muchos a uno, según tu lógica)
    public function rol()
    {
        return $this->belongsTo(type_users::class);
    }


}
