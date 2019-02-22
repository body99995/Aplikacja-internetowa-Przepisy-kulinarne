<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AndroidUserLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('android_user_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_android_user')->unsigned();
            $table->foreign('id_android_user')->references('id')->on('android_users')->onDelete('cascade');
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('android_user_logs');
    }
}
