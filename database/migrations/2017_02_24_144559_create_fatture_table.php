<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFattureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatture', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('numero')->unsigned();
            $table->string('dettaglio_prestazione');
            $table->decimal('importo_netto', 10, 2);
            $table->decimal('importo_esente', 10, 2);
            $table->integer('appartenenza')->unsigned(); // 1 -> elys, 2 -> elisir
            
            $table->integer('pratica_id')->unsigned();
            $table->foreign('pratica_id')->references('pratiche')->on('id');
            
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
        Schema::drop('fatture');
    }
}
