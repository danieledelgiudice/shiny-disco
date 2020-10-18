<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamenti', function (Blueprint $table) {
            $table->increments('id');

            $table->date('data');
            $table->decimal('importo', 10, 2);
            $table->boolean('cose')->default(0);
            $table->boolean('persone')->default(0);
            $table->boolean('spese_mediche')->default(0);

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
        Schema::drop('pagamenti');
    }
}
