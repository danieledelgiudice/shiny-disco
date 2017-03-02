<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFatturaSospesoToPrestazioniMediche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prestazioniMediche', function (Blueprint $table) {
            $table->boolean('sospeso');
            $table->boolean('fattura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prestazioniMediche', function (Blueprint $table) {
            $table->dropColumn('sospeso');
            $table->dropColumn('fattura');
        });
    }
}
