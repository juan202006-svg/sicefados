<?php

namespace Modules\ACUAPONICO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ACUAPONICODatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        
        $this->call(AppTableSeeder::class); 
        $this->call(PeopleTableSeeder::class); 
        $this->call(UsersTableSeeder::class); 
        $this->call(RolesTableSeeder::class); 
        $this->call(PermissionsTableSeeder::class);

    
        DB::commit(); 

        // $this->call("OthersTableSeeder");
    }
}
