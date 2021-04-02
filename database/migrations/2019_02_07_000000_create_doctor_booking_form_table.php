<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorBookingFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_booking_form', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id', $autoIncrement = false)->unsigned();
            $table->integer('doctor_id', $autoIncrement = false)->unsigned();
            $table->string('reason',255)->nullable();
            $table->string('description',255)->nullable();
            $table->text('report_file')->nullable();
            $table->boolean('report')->nullable();     // 1 -> Yes  2 -> No
            $table->timestamps();
        });

        Schema::table('doctor_booking_form', function ($table) {
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
        Schema::dropIfExists('doctor_booking_form');
    }
}
