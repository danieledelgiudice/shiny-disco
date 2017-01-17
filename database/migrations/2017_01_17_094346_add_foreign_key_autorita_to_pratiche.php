<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyAutoritaToPratiche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pratiche', function (Blueprint $table) {
            $table->integer('autorita_id')->unsigned()->nullable();
            $table->foreign('autorita_id')->references('id')->on('autorita');
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
            $table->dropForeign('pratiche_autorita_id_foreign');
            $table->dropColumn('autorita_id');
        });
    }
}
