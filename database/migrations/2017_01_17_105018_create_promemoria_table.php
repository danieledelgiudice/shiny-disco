<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromemoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promemoria', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('chi');
            $table->date('quando');
            $table->text('cosa');
            
            $table->integer('pratica_id')->unsigned();
            $table->foreign('pratica_id')->references('id')->on('pratiche');
            
            $table->softDeletes();
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
        Schema::drop('promemoria');
    }
}
