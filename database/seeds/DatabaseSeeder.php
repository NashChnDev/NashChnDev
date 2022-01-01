<?php

use Illuminate\Database\Seeder;
//use App\database\seeds\userseeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(userseeder::class);
         $this->call(RolesTableSeeder::class);
    }
}
