<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondivisioniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condivisioni', function (Blueprint $table) {
            $table->integer('pratica_id')->unsigned();
            $table->integer('filiale_id')->unsigned();
            
            $table->foreign('pratica_id')->references('id')->on('pratiche');
            $table->foreign('filiale_id')->references('id')->on('filiali');

            $table->unique(['pratica_id', 'filiale_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('condivisioni');
    }
}
