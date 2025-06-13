<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    public $timestamps = false; 
    use HasFactory;

    protected $table = 'type_users';
    protected $fillable = [
        'name',
        'description'
    ];

    public function personas()
    {
        return $this->hasMany(Persona::class);
    }
}
