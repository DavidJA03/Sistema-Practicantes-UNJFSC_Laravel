<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener el usuario admin creado
        $user = User::where('email', 'admin@gmail.com')->first();
        
        if ($user) {
            Persona::create([
                'codigo' => 'ADMIN00001',
                'nombres' => 'David',
                'apellidos' => 'Admin',
                'correo_inst' => 'admin@gmail.com',
                'departamento' => 'Lima Provincias',
                'usuario_id' => $user->id,
                'rol_id' => 1, // admin
                'date_create' => now(),
                'date_update' => now(),
                'estado' => 1,
            ]);
        }
    }
}
