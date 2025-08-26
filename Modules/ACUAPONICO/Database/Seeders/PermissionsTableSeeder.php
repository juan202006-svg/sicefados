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

        $app = App::where('name', 'ACUAPONICO')->first();




        //permiso para el Rol de administrador

        //registro de home
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.layouts.masterusers'], [ // Registro o actualización de permiso
            'name' => 'Acceso a la página de inicio',
            'description' => 'Acceso a la página de inicio',
            'description_english' => 'Access to the home page',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de configuración (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Administrador',
            'description' => 'Acceso al Rol de Administrador',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de configuración (administrador)
        //vista de Usuarios
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.usuarios'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de usuarios',
            'description' => 'Vista de usuarios',
            'description_english' => 'Access to the list of users',
            'app_id' => $app->id
        ]);

        $permissions_admin[] = $permission->id;

        //crear Usuario
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.storeUsuarios'], [ // Registro o actualización de permiso
            'name' => 'Crear usuarios',
            'description' => 'Crear usuarios',
            'description_english' => 'Create users',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        //editar Usuario
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.updateUsuarios'], [ // Registro o actualización de permiso
            'name' => 'Actualizar usuarios',
            'description' => 'Actualizar usuarios',
            'description_english' => 'Update users',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        
        //acceso a la vista de registro de lotes admin
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.registrolote'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de registro de lotes',
            'description' => 'Vista de registro de lotes',
            'description_english' => 'Access batch registration list',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol


        //acceso a la vista de registro de categorias admin
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.registrocategoria'], [ //Registro o actualización de permiso
            'name' => 'Acceso lista de registro de categorias',
            'description' => 'Vista de registro de categorias',
            'description_english' => 'Access to the category registration list',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id;


        //acceso a la vista de registro especies admin
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.registroespecie'], [ //Registro o actualización de permiso
            'name' => 'Acceso lista de registro de especies',
            'description' => 'Vista de registro de especies',
            'description_english' => 'Access to the species registration list',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id;

        //acceso a la vista de registro de cultivos admin
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.registrocultivo'], [ //Registro o actualización de permiso
            'name' => 'Acceso lista de registro de cultivos',
            'description' => 'Vista de registro de cultivos',
            'description_english' => 'Access to the crop registration list',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id;

        //acceso a la vista de seguimientos de peces y plantas admin
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.registroseguimiento'], [ //Registro o actualización de permiso
            'name' => 'Acceso lista de registro de seguimientos',
            'description' => 'Vista de registro de seguimientos',
            'description_english' => 'Access to the tracking registration list',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id;


        //acceso a la vista de registroacuaponicos
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.registroacuaponicos'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de registro de sistemas acuapónicos',
            'description' => 'Vista de registro de sistemas acuapónicos',
            'description_english' => 'Access to the list of aquaponic systems registration',
            'app_id' => $app->id
        ]);

        $permissions_admin[] = $permission->id;

        //acceso a la vista de gestion de resiembras
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.registroresiembras'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de registro de resiembras',
            'description' => 'Vista de registro de resiembras',
            'description_english' => 'Access to the list of resowing registration',
            'app_id' => $app->id
        ]);

        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.registroseguimiento'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de registro de seguimientos de resiembras',
            'description' => 'Vista de registro de seguimientos de resiembras',
            'description_english' => 'Access to the tracking registration list of resowings',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;


        //acceso a la vista de seguimientos generales
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.seguimientogeneral'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de seguimientos generales',
            'description' => 'Vista de seguimientos generales',
            'description_english' => 'Access to the general tracking list',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;


        //acceso a la vista de seguimientos de peces
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.pezseguimiento'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de seguimientos de peces',
            'description' => 'Vista de seguimientos de peces',
            'description_english' => 'Access to the fish tracking list',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        //acceso a la vista de seguimientos de plantas
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.plantaseguimiento'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de seguimientos de plantas',
            'description' => 'Vista de seguimientos de plantas',
            'description_english' => 'Access to the plant tracking list',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;


        //acceso a la vista de cosechas
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.admin.admin.registrocosecha'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de registro de cosechas',
            'description' => 'Vista de registro de cosechas',
            'description_english' => 'Access to the list of harvest registration',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

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

         $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.createLot'], [ // Registro o actualización de permiso
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


        // lista  de Permisos para la gestion de especies
        //vista de lista de especies
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.indexspecies'], [ // Registro o actualización de permiso
            'name' => 'Acceso lista de especies',
            'description' => 'Vista de especies',
            'description_english' => 'Access to the list of species',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id;

        //crear especie
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.creatspecies'], [ // Registro o actualización de permiso
            'name' => 'Crear especie',
            'description' => 'Crear especie',
            'description_english' => 'Create species',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.storespecies'], [ // Registro o actualización de permiso
            'name' => 'Guardar especie',
            'description' => 'Guardar especie',
            'description_english' => 'Save species',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol

        //actualizar especie
        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.updatespecies'], [ // Registro o actualización de permiso
            'name' => 'Actualizar especie',
            'description' => 'Actualizar especie',
            'description_english' => 'Update species',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol

        //eliminar especie

        $permission = Permission::updateOrCreate(['slug' => 'acuaponico.pasante.pasante.destroyspecies'], [ // Registro o actualización de permiso
            'name' => 'Eliminar especie',
            'description' => 'Eliminar especie',
            'description_english' => 'Delete species',
            'app_id' => $app->id
        ]);
        $permissions_pasante[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES

        $rol_pasante = Role::where('slug', 'acuaponico.pasante')->first(); // Rol Administrador
       

        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
       
        $rol_pasante->permissions()->syncWithoutDetaching($permissions_pasante);
    }
}