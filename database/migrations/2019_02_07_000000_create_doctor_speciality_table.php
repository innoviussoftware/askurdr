<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorSpecialityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_speciality', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', $autoIncrement = false)->unsigned();
            $table->integer('speciality_id', $autoIncrement = false)->unsigned();
            $table->timestamps();
        });

        Schema::table('doctor_speciality', function ($table) {
            $table->foreign('user_id', $autoIncrement = false)->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('speciality_id', $autoIncrement = false)->unsigned()->references('id')->on('speciality')->onDelete('cascade')->onUpdate('cascade');
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
