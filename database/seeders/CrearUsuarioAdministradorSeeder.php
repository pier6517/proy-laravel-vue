<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CrearUsuarioAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario=User::create([
            'name'=>'super usuario',
            'email'=>'admin@correo.com',
            'password'=> bcrypt('123456')
            
        ]);


        $rol=Role::create([
            'name'=> 'Administrador'
        ]);

        $permisos=Permission::pluck('id','id')->all();
        $rol->syncPermissions($permisos);
        $usuario->assignRole($rol->id);
        
    }
}
