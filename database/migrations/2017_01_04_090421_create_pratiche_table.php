<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePraticheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pratiche', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('numero_pratica')->nullable();                // ?
            $table->integer('numero_registrazione')->nullable();                    // ?
            $table->integer('stato_pratica')->nullable();
            $table->string('tipo_pratica')->nullable();
            $table->date('data_apertura')->nullable();
            
            $table->string('veicolo_parte')->nullable();
            $table->string('targa_parte')->nullable();
            $table->string('numero_polizza_parte')->nullable();
            
            $table->string('conducente_controparte')->nullable();
            $table->string('via_controparte')->nullable();
            $table->string('citta_controparte')->nullable();
            $table->string('telefono_controparte')->nullable();
            $table->string('veicolo_controparte')->nullable();
            $table->string('targa_controparte')->nullable();
            $table->string('numero_polizza_controparte')->nullable();
            $table->string('proprietario_mezzo_responsabile')->nullable();  // ?
            $table->string('medico_controparte')->nullable();
            $table->string('luogo_medico_controparte')->nullable();
            $table->string('data_medico_controparte')->nullable();
            $table->string('liquidatore')->nullable();
            $table->string('reperibilita_liquidatore')->nullable();
            $table->decimal('parcella_presunta', 10, 2)->nullable();
            
            $table->string('legale')->nullable();
            $table->date('in_data')->nullable();
            $table->integer('controllato')->nullable();
            $table->date('data_ultima_lettera')->nullable();
            $table->date('mezzo_liquidato')->nullable();                
            $table->decimal('valore_mezzo_liquidato', 10, 2)->nullable();
            $table->integer('rilievi')->nullable();                         // pseudo enum
            $table->date('data_chiusura')->nullable();
            $table->decimal('importo_sospeso', 10, 2)->nullable();
            $table->date('data_sospeso')->nullable();
            $table->decimal('onorari_omnia', 10, 2)->nullable();
            $table->decimal('liquidato_omnia', 10, 2)->nullable();
            $table->text('stato_avanzamento')->nullable();

            $table->date('data_sinistro')->nullable();
            $table->string('ora_sinistro')->nullable();
            $table->string('luogo_sinistro')->nullable();
            $table->string('comando_autorita')->nullable();
            $table->string('testimoni')->nullable();
            $table->integer('rivalsa')->nullable();             // pseudo enum
            $table->integer('soccorso')->nullable();            // pseudo enum
            $table->string('tipologia_intervento')->nullable();
            $table->decimal('danno_presunto', 10, 2)->nullable();
            $table->string('numero_sinistro')->nullable();
            
            $table->string('assicurazione_risarcente')->nullable();
            $table->string('assicurazione_responsabile')->nullable();
            $table->text('mezzo_visibile')->nullable();
            $table->text('dinamica_sinistro')->nullable();
            $table->text('note')->nullable();
            
            $table->integer('cliente_id')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pratiche');
    }
}
