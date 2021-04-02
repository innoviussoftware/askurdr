<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id', $autoIncrement = false)->unsigned();
            $table->integer('doctor_id', $autoIncrement = false)->unsigned();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('time_slot')->nullable();
            $table->timestamps();
        });

        Schema::table('doctor_booking', function ($table) {
            $table->foreign('patient_id', $autoIncrement = false)->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('doctor_id', $autoIncrement = false)->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
