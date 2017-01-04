<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyOnClienteIdOnPratiche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pratiche', function (Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('clienti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pratiche', function (Blueprint $table) {
            $table->dropForeign('pratiche_cliente_id_foreign');
        });
    }
}
