<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataEmissioneToFattureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fatture', function (Blueprint $table) {
            $table->date('data_emissione')->after('dettaglio_prestazione');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fatture', function (Blueprint $table) {
            $table->dropColumn('data_emissione');
        });
    }
}
