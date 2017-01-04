<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clienti', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('nome');
            $table->string('cognome');
            
            $table->integer('sesso');                       // pseudo enum
            $table->date('nato_il')->nullable();
            $table->string('nato_a')->nullable();
            $table->string('codice_fiscale')->nullable();
            
            $table->string('via')->nullable();
            $table->string('città')->nullable();
            $table->string('provincia', 2)->nullable();     // relazione?
            $table->string('cap', 5)->nullable();
            
            $table->string('cellulare')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('fax')->nullable();
            
            $table->string('piva')->nullable();
            $table->string('tipo_documento')->nullable();   // relazione o enum?
            $table->string('numero_documento')->nullable();
            
            $table->integer('stato_civile')->nullable();    // pseudo enum
            //$table->string('professione')->nullable();    // deve diventare una relazione
            $table->decimal('reddito', 10, 2)->nullable();
            $table->string('numero_card')->nullable();
            $table->text('note')->nullable();
            
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
        Schema::drop('clients');
    }
}
