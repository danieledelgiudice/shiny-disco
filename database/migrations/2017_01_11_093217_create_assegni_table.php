<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssegniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assegni', function (Blueprint $table) {
            $table->increments('id');
            
            $table->date('data');
            $table->decimal('importo', 10, 2);
            $table->string('banca');
            
            $table->date('data_azione');
            $table->integer('tipologia');
            
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
        Schema::drop('assegni');
    }
}
