<?php

namespace Database\Seeders;

use App\Models\type_users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Administrador', 'estado' => 1],
            ['name' => 'Docente Titular', 'estado' => 1],
            ['name' => 'Docente Supervisor', 'estado' => 1],
            ['name' => 'Estudiante', 'estado' => 1],
        ];

        foreach ($types as $type) {
            type_users::create([
                'name' => $type['name'],
                'estado' => $type['estado'],
                'date_create' => now(),
                'date_update' => now(),
            ]);
        }
    }
}
