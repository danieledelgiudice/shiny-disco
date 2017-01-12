<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyProfessioneToClienti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clienti', function (Blueprint $table) {
            $table->integer('professione_id')->unsigned()->nullable();
            $table->foreign('professione_id')->references('id')->on('professioni');
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
            $table->dropForeign('clienti_professione_id_foreign');
            $table->dropColumn('professione_id');
        });
    }
}
