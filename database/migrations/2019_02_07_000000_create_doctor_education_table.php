<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', $autoIncrement = false)->unsigned();
            $table->string('institute_name',255)->nullable();
            $table->string('course',255)->nullable();
            $table->string('year',255)->nullable();
            $table->timestamps();
        });

        Schema::table('doctor_education', function ($table) {
            $table->foreign('user_id', $autoIncrement = false)->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_services');
    }
}
