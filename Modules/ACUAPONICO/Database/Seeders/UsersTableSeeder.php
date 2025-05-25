<?php

namespace Modules\ACUAPONICO\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Person;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $person = Person::where('document_number', 1075791878)->first();
        User::updateOrCreate(['nickname' => 'Hamiltonortiz'], [
            'person_id' => $person->id,
            'email' => 'ortizrodriguezhaminton18@gmail.com' //Haor1878   
           ]);

           $person = Person::where('document_number', 1075508361)->first();
           User::updateOrCreate(['nickname' => 'Juanguzman'], [
               'person_id' => $person->id,
               'email' => 'guzmanhernandezj603@gmail.com' //Jugu8361
              ]);

              $person = Person::where('document_number', 1075502024)->first();
              User::updateOrCreate(['nickname' => 'Tatianaoino'], [
                 'person_id' => $person->id,
                 'email' => 'tatianaoino@gmail.com' //Taoi2024  
              ]);  
}
}