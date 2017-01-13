<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompagnieAssicurativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compagnieAssicurative', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('nome');
            $table->string('indirizzo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('giorni')->nullable();
            $table->text('note')->nullable();
            
            $table->integer('filiale_id')->unsigned();
            $table->foreign('filiale_id')->references('id')->on('filiali');
            
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
        Schema::drop('compagnieAssicurative');
    }
}
