<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\TypeUserSeeder;
use Database\Seeders\PersonaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TypeUserSeeder::class,
            UserSeeder::class,
            PersonaSeeder::class
        ]);
    }
}
