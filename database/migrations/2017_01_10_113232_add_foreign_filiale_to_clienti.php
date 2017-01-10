<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignFilialeToClienti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clienti', function (Blueprint $table) {
            $table->integer('filiale_id')->unsigned();
            $table->foreign('filiale_id')->references('id')->on('filiali');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clienti', function (Blueprint $table) {
            $table->dropForeign('clienti_filiale_id_foreign');
            $table->dropColumn('filiale_id');
        });
    }
}
