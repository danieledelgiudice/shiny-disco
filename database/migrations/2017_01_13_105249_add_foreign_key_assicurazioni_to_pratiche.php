<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyAssicurazioniToPratiche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pratiche', function (Blueprint $table) {
            $table->integer('assicurazione_parte_id')->unsigned()->nullable();
            $table->integer('assicurazione_controparte_id')->unsigned()->nullable();
            
            $table->foreign('assicurazione_parte_id')->references('id')->on('compagnieAssicurative');
            $table->foreign('assicurazione_controparte_id')->references('id')->on('compagnieAssicurative');
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
            $table->dropForeign('pratiche_assicurazione_parte_id_foreign');
            $table->dropForeign('pratiche_assicurazione_controparte_id_foreign');
            
            $table->dropColumn('assicurazione_parte_id');
            $table->dropColumn('assicurazione_controparte_id');
        });
    }
}
