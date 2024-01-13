<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /* Run the database seeds. */
    public function run(): void
    {
         DB::table('users')->insert([
            "name"=>'super admin',
            "phone" => "01638107361",
            "role_id"=>1,
            "email"=>'superadmin@gmail.com',
            "password"=>bcrypt(12345678)
        ]);
        
        DB::table('users')->insert([
            "name"=>'admin',
            "phone" => "01287107361",
            "role_id"=>2,
            "email"=>'admin@gmail.com',
            "password"=>bcrypt(12345678)
        ]);

        DB::table('users')->insert([
            "name" => 'employee',
            "phone" => "01258107361",
            "role_id" => 3,
            "email" => 'employee@gmail.com',
            "password" => bcrypt(12345678)
        ]);

        DB::table('users')->insert([
            "name" => 'customer',
            "phone" => "01328107361",
            "role_id" => 4,
            "email" => 'customer@gmail.com',
            "password" => bcrypt(12345678)
        ]);
    }
}
