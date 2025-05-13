<?php

namespace Modules\ACUAPONICO\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear una lista de permisos para el rol 
        $permissions_admin = []; // Lista de permisos para el rol de administrador

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'ACUAPONICO')->first();




        //permiso para el Rol de administrador

        // Vista de configuración (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Administrador',
            'description' => 'Acceso al Rol de Administrador',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol


        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'acuaponico.admin')->first(); // Rol Administrador

        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);






        //permiso para el rol de pasante

        //crear una lista de permisos pera el rol
        $permissions_pasante = []; // Lista de permisos para el rol de pasante

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'ACUAPONICO')->first();

        //permisos para el rol de pasante - ACUAPONICO
        //entra a la vista de pasante
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.welcomepas'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Pasante',
            'description' => 'Acceso al Rol de Pasante',
            'description_english' => 'Access to the intern Role',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; 

        //vista de configuracion (pasante)



        // Vista de configuración (pasante)
        //vista de gestion de lotes
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.index'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de Gestion de Lotes',
            'description' => 'Vista de Gestion de Lotes',
            'description_english' => 'Access to the list of lots',
            'app_id' => $app->id
        ]);

        $permissions_pasante[] = $permission->id;

        


        //crear lote
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.storeLot'], [ // Registro o actualización de permiso
            'name' => 'Crear lote',
            'description' => 'Crear lote',
            'description_english' => 'Create lot',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.updateLot'], [ // Registro o actualización de permiso
            'name' => 'Actualizar lote',
            'description' => 'Actualizar lote',
            'description_english' => 'Update lot',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.destroyLot'], [ // Registro o actualización de permiso
            'name' => 'Eliminar lote',
            'description' => 'Eliminar lote',
            'description_english' => 'Delete lot',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol




        //acceso a la vista de categorias
        // Vista de configuración (pasante)
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.categoria'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de categorias',
            'description' => 'Vista de categorias',
            'description_english' => 'Access to the list of categories',
            'app_id' => $app->id
        
        ]);
        $permissions_pasante[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.createCategory'], [ // Registro o actualización de permiso
            'name' => 'Crear categoria',
            'description' => 'Crear categoria',
            'description_english' => 'Create category',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.updateCategory'], [ // Registro o actualización de permiso
            'name' => 'Actualizar categoria',
            'description' => 'Actualizar categoria',
            'description_english' => 'Update category',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol 

        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.destroyCategory'], [ // Registro o actualización de permiso
            'name' => 'Eliminar categoria',
            'description' => 'Eliminar categoria',
            'description_english' => 'Delete category',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol


        //crear el rol del pasante

        // Consulta de ROLES

        $rol_pasante = Role::where('slug', 'acuaponico.pasante')->first(); // Rol Administrador
       

        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
       
        $rol_pasante->permissions()->syncWithoutDetaching($permissions_pasante);
    }
}