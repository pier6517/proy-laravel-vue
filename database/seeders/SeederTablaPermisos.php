<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos=[
            //tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
            //tabla post
            'ver-post',
            'crear-post',
            'editar-post',
            'borrar-post',
            //tabla categoria
            'ver-category',
            'crear-category',
            'editar-category',
            'borrar-category',
            //administracion roles usuarios.
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'borrar-usuarios',
            // replis
            'reply-list',
            'reply-create',
            'reply-edit',
            'reply-delete'

        ];
        foreach ($permisos as $permiso){
            Permission::create([
                'name'=>$permiso
            ]);
        }
    }
}
