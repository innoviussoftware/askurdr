<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        DB::table('roles')->insert(
                ['name' => 'admin', 'display_name' => 'Admin']
        );
        DB::table('roles')->insert(
                ['name' => 'doctor', 'display_name' => 'Doctor']
        );
        DB::table('roles')->insert(
                ['name' => 'patient', 'display_name' => 'Patient']
        );
        DB::table('roles')->insert(
                ['name' => 'pharmacy', 'display_name' => 'Pharmacy']
        );
        DB::table('roles')->insert(
                ['name' => 'labs', 'display_name' => 'Labs']
        );
    }
}
