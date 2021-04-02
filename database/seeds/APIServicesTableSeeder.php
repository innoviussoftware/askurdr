<?php

use Illuminate\Database\Seeder;

class APIServicesTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('api_services')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1
        DB::table('api_services')->insert(
          ['name' => 'Login',
           'url' => 'api/login',
           'method'=>'POST',
           'headers'=>'',
           'parameter' => 'email | password | device_id ',
           'description'=>'',
           'created_at'=>date('Y-m-d h:i:s')
          ]
        );

        // 2
        DB::table('api_services')->insert(
          ['name' => 'Register',
           'url' => 'api/register',
           'method'=>'POST',
           'headers'=>'',
           'parameter' => 'first_name | last_name | email | post_mail | mobile | gender | date_of_birth | password | device_id | language | insurance_company_name | insurance_policy_no',
           'description'=>'',
           'created_at'=>date('Y-m-d h:i:s')
          ]
        );
        
    }
}
