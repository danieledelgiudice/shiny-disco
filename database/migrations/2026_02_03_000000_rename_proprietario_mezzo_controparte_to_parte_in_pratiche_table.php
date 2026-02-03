<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameProprietarioMezzoControparteToParteInPraticheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pratiche', function (Blueprint $table) {
            $table->string('proprietario_mezzo_parte')->nullable()->after('proprietario_mezzo_responsabile');
        });

        DB::statement('UPDATE pratiche SET proprietario_mezzo_parte = proprietario_mezzo_controparte');

        Schema::table('pratiche', function (Blueprint $table) {
            $table->dropColumn('proprietario_mezzo_controparte');
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
            $table->string('proprietario_mezzo_controparte')->nullable()->after('proprietario_mezzo_responsabile');
        });

        DB::statement('UPDATE pratiche SET proprietario_mezzo_controparte = proprietario_mezzo_parte');

        Schema::table('pratiche', function (Blueprint $table) {
            $table->dropColumn('proprietario_mezzo_parte');
        });
    }
}
