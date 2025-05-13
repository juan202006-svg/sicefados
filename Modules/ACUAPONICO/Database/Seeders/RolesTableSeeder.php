<?php

namespace Modules\ACUAPONICO\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'ACUAPONICO')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'acuaponico.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación ACUAPONICO',
            'description_english' => 'ACUAPONIC application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $rolpasante = Role::updateOrCreate(['slug' => 'acuaponico.pasante'], [
            'name' => 'pasante',
            'description' => 'Rol pasante de la aplicación ACUAPONICO',
            'description_english' => 'ACUAPONIC application intern role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);
        

        $useradministrador = User::where('nickname', 'Hamiltonortiz')->firstOrFail();
        $useradministrador = User::where('nickname', 'Juanguzman')->firstOrFail();
        $userpasante = User::where('nickname', 'Tatianaoino')->firstOrFail();

        

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);
        $userpasante->roles()->syncWithoutDetaching([$rolpasante->id]);
}
}