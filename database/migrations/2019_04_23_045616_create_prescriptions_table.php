<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', $autoIncrement = false)->unsigned();
            $table->string('prescription_number',255)->nullable();
            $table->string('dose',255)->nullable();
            $table->string('route',255)->nullable();
            $table->string('frequency',255)->nullable();
            $table->string('frequency2',255)->nullable();
            $table->string('frequency3',255)->nullable();
            $table->string('duration',255)->nullable();
            $table->text('notetopharmacy')->nullable();
            $table->string('diagnosis',255)->nullable();
            $table->boolean('status')->default(1); 
            $table->timestamps();
        });

        Schema::table('prescriptions', function ($table) {
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
        Schema::dropIfExists('prescriptions');
    }
}
