<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45);
            
            $table->enum('category', array('Ciastka', 'Drinki', 'Napoje', 'Przystawki', 'Zupy'));
            
            $table->longText('description');
            $table->longText('components');
            $table->longText('way_of_preparation');
            
            $table->string('main_photo');
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
            
            /*$table->binary('zdjecie_glowne');
            $table->binary('fot1')->nullable();
            $table->binary('fot2')->nullable();
            $table->binary('fot3')->nullable();*/
            
            $table->string('URL_video',400)->nullable();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
