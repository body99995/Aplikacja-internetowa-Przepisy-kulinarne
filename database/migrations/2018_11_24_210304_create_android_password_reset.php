<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAndroidPasswordReset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('android_password_change', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_android_users')->unsigned();   
            $table->foreign('id_android_users')->references('id')->on('android_users')->onDelete('cascade');
            $table->enum('type_of_change', array('change', 'reset'));
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
        Schema::dropIfExists('android_password_change');
    }
}
