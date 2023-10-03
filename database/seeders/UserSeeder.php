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
         /* admin create information */
         DB::table('users')->insert([
            "name"=>'admin',
            "phone" => "01638107361",
            "role_id"=>1,
            "email"=>'admin@gmail.com',
            "password"=>bcrypt(12345678)
        ]);

        /* user create information */
        DB::table('users')->insert([
            "name"=>'user',
            "phone" => "0128107361",
            "role_id"=>2,
            "email"=>'user@gmail.com',
            "password"=>bcrypt(12345678)
        ]);
    }
}
