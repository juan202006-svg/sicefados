<?php

namespace Modules\ACUAPONICO\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Environment;

class EnvironmentsTableSeeder extends Seeder
{
    public function run()
    {
        Environment::firstOrCreate(
            ['name' => 'Unidad Acuicola'],
            [
                'picture' => null,
                'description' => null,
                'length' => '-75.362374',
                'latitude' => '2.613140',
                'farm_id' => 1,
                'status' => 'Disponible',
                'type_environment' => null,
                'class_environment_id' => 4
            ]
        );
    }
}
