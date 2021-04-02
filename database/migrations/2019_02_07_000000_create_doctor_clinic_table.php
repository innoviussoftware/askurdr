<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorClinicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_clinic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', $autoIncrement = false)->unsigned();
            $table->integer('clinic_id', $autoIncrement = false)->unsigned();
            $table->timestamps();
        });

        Schema::table('doctor_clinic', function ($table) {
            $table->foreign('user_id', $autoIncrement = false)->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('clinic_id', $autoIncrement = false)->unsigned()->references('id')->on('clinic')->onDelete('cascade')->onUpdate('cascade');
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
