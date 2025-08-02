<?php

namespace Modules\ACUAPONICO\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Registro o actualización de la nueva aplicación para sistema acuaponico */
        $app = App::updateOrCreate(['name' => 'ACUAPONICO'], [
            'url' => '/acuaponico/index',
            'color' => '#1c4684ff',
            'icon' => 'fas fa-fish',
            'description' => 'Gestion del sistema acuaponito',
            'description_english' => 'Aquaponite system management'
        ]);

        
    }
}
