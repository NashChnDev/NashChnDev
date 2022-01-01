<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name'               => 'admin',
            'email'              => 'admin@gmail.com',
            'email_verified_at'  => '2019-08-20 00:00:00',
            'password'           => bcrypt('admin123'),
        ]);
    }
}
