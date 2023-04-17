<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\SeederTablaPermisos;
use Database\Seeders\CrearUsuarioAdministradorSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SeederTablaPermisos::class,
            CrearUsuarioAdministradorSeeder::class,
            
        ]);
    }
}
