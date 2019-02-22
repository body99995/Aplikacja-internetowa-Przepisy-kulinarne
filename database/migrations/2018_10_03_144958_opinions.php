<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Opinions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_android_users')->unsigned();
            $table->foreign('id_android_users')->references('id')->on('android_users')->onDelete('cascade');
            $table->integer('id_recipe')->unsigned();
            $table->foreign('id_recipe')->references('id')->on('recipes')->onDelete('cascade');
            $table->longText('opinion');
            $table->enum('rating', array('1', '2', '3', '4', '5'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opinions');
    }
}
