<?php

namespace Modules\ACUAPONICO\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\AppProductiveUnit;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\Warehouse;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Registro o actualización de la nueva aplicación para Estación de Café */
        $app = App::updateOrCreate(['name' => 'ACUAPONICO'], [
            'url' => '/acuaponico/index',
            'color' => '#76250C',
            'icon' => 'fas fa-fish',
            'description' => 'Gestion del sistema acuaponito',
            'description_english' => 'Aquaponite system management'
        ]);

        
    }
}
