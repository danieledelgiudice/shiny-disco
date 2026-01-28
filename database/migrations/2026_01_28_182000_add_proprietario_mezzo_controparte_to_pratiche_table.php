<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProprietarioMezzoControparteToPraticheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pratiche', function (Blueprint $table) {
            $table->string('proprietario_mezzo_controparte')->nullable()->after('proprietario_mezzo_responsabile');
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
            $table->dropColumn('proprietario_mezzo_controparte');
        });
    }
}
