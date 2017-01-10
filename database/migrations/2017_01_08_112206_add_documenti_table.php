<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documenti', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('descrizione');
            $table->string('mime');
            $table->string('nome_file');
            $table->string('nome_file_originale');
            
            $table->integer('pratica_id')->unsigned();
            
            $table->foreign('pratica_id')->references('id')->on('pratiche');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('documenti');
    }
}
