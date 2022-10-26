<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use  Spatie\Permission\Models\Permission; 

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $RoleAdmin=Role::create(['name'=>'Administrador']);
        $RoleLiqui=Role::create(['name'=>'Liquidador']);

        Permission::create(['name'=>'ver-termino'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'crear-termino'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'editar-termino'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'detalle-categoria'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'duplicar-categoria'])->syncRoles($RoleAdmin);
        
        Permission::create(['name'=>'ver-liquidacion'])->syncRoles([$RoleAdmin,$RoleLiqui]);
        Permission::create(['name'=>'crear-liquidacion'])->syncRoles([$RoleAdmin,$RoleLiqui]);
        Permission::create(['name'=>'editar-liquidacion'])->syncRoles([$RoleAdmin,$RoleLiqui]);
        Permission::create(['name'=>'detalle-liquidacion'])->syncRoles([$RoleAdmin,$RoleLiqui]);
        Permission::create(['name'=>'pdfpb-liquidacion'])->syncRoles([$RoleAdmin,$RoleLiqui]);
        Permission::create(['name'=>'pdfzn-liquidacion'])->syncRoles([$RoleAdmin,$RoleLiqui]);
        
        Permission::create(['name'=>'ver-penalidad'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'crear-penalidad'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'editar-penalidad'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'detalle-penalidad'])->syncRoles($RoleAdmin);

        Permission::create(['name'=>'ver-cliente'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'crear-cliente'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'editar-cliente'])->syncRoles($RoleAdmin);
        Permission::create(['name'=>'detalle-cliente'])->syncRoles($RoleAdmin);

        Permission::create(['name'=>'ver-usuario'])->syncRoles([$RoleAdmin]);
        Permission::create(['name'=>'crear-usuario'])->syncRoles([$RoleAdmin]);
        Permission::create(['name'=>'editar-usuario'])->syncRoles([$RoleAdmin]);
        Permission::create(['name'=>'detalle-usuario'])->syncRoles([$RoleAdmin]);

        Permission::create(['name'=>'ver-rol'])->syncRoles([$RoleAdmin]);
        Permission::create(['name'=>'crear-rol'])->syncRoles([$RoleAdmin]);
        Permission::create(['name'=>'editar-rol'])->syncRoles([$RoleAdmin]);
        Permission::create(['name'=>'detalle-rol'])->syncRoles([$RoleAdmin]);
        Permission::create(['name'=>'borrar-rol'])->syncRoles([$RoleAdmin]);
       
    }
}
