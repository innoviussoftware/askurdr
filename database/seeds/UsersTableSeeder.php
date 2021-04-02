<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('users')->insert(
          ['first_name' => 'admin',
           'last_name' => '',
           'email'=>'eclinic@gmail.com',
           'password' => app('hash')->make('eclinic'),
           'created_at'=>date('Y-m-d h:i:s')
          ]
        );
        DB::table('role_user')->insert(['user_id' => 1, 'role_id' => 1]);
    }
}
