<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSegnalatoDaToPratiche extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pratiche', function (Blueprint $table) {
            $table->string('segnalato_da')->nullable();
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
            $table->dropColumn('segnalato_da');
        });
    }
}
