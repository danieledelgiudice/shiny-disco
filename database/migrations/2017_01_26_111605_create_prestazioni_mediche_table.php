<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestazioniMedicheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestazioniMediche', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('nome_medico');
            $table->date('data');
            $table->integer('giorni')->unsigned();
            $table->decimal('costo', 10, 2)->unsigned();
            $table->integer('percentuale')->unsigned()->default(0);
            
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
        Schema::drop('prestazioniMediche');
    }
}
