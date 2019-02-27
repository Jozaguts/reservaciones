<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // rol y permisos para administrar usuarios
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);
        
        //permisos para comisionistas
        Permission::create(['name' => 'create commission-agents']);
        Permission::create(['name' => 'update commission-agents']);
        Permission::create(['name' => 'delete commission-agents']);

        //permisos para adminstrar reservaciones

        Permission::create(['name' => 'create reservations']);
        Permission::create(['name' => 'update reservations']);
        Permission::create(['name' => 'delete reservations']);

       

        $role = Role::create(['name' => 'operador']);
        $role->givePermissionTo(['create reservations','update reservations']);

        // or may be done by chaining
        $role = Role::create(['name' => 'supervisor'])
            ->givePermissionTo(['create reservations','update reservations','delete reservations','create commission-agents','update commission-agents','delete commission-agents']);

        $role = Role::create(['name' => 'administrador']);
        $role->givePermissionTo(Permission::all());







        
    }
}
