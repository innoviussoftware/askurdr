<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_experience', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', $autoIncrement = false)->unsigned();
            $table->string('hospital_name',255)->nullable();
            $table->string('position',255)->nullable();
            $table->string('year',255)->nullable();
            $table->timestamps();
        });

        Schema::table('doctor_experience', function ($table) {
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
