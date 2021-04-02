<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name',64);
            $table->string('last_name',64)->nullable();
            $table->string('email')->unique();
            $table->string('post_mail')->nullable();
            $table->string('mobile',64)->nullable();
            $table->string('password',255);
            $table->string('gender',64)->default('male')->nullable();
            $table->string('date_of_birth',64)->nullable();
            $table->string('age',255)->nullable();
            $table->string('profile_pic',255)->nullable();
            $table->string('device_id',255)->nullable();
            $table->string('language',64)->nullable();
            $table->string('insurance_company_name',255)->nullable();
            $table->string('insurance_policy_no',255)->nullable();
            $table->string('description',255)->nullable();
            $table->string('emr_number',64)->nullable();
            $table->rememberToken();
            $table->boolean('status')->default(1);  // 1 -> Active  0 -> Inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
