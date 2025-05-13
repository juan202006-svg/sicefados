<?php

namespace Modules\ACUAPONICO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\PopulationGroup;

class PeopleTableSeeder extends Seeder
{
    public function run()
     {
        $population_group = PopulationGroup::firstOrCreate(['name' => 'NINGUNA']);
        $eps = EPS::firstOrCreate(['name' => 'NO REGISTRA']);
        $pension_entity = PensionEntity::firstOrCreate(['name' => 'NO REGISTRA']);

        Person::firstOrCreate(['document_number' => 1075791878], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'Hamilton',
            'first_last_name' => 'Ortiz',
            'second_last_name' => 'Rodriguez',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
   ]);

        Person::firstOrCreate(['document_number' => 1075508361], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'Juan',
            'first_last_name' => 'Guzman',
            'second_last_name' => 'Hernandez',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
   ]);
           Person::firstOrCreate(['document_number' => 1075502024], [
            'document_type' => 'Cédula de ciudadanía',
            'first_name' => 'Tatiana',
            'first_last_name' => 'Oino',
            'second_last_name' => 'Olcunche',
            'eps_id' => $eps->id,
            'population_group_id' => $population_group->id,
            'pension_entity_id' => $pension_entity->id
   ]);

   
  
   
   
}
}