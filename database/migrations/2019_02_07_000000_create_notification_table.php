<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_id', $autoIncrement = false)->unsigned();
            $table->integer('to_id', $autoIncrement = false)->unsigned();
            $table->string('message', 255)->nullable();
            $table->timestamps();
        });

        Schema::table('notification', function ($table) {
            $table->foreign('from_id', $autoIncrement = false)->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_id', $autoIncrement = false)->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification');
    }
}
