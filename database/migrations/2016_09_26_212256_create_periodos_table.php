<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('periodo');
                $table->integer('banda_id')->nullable()->unsigned();
                $table->integer('disco_id')->nullable()->unsigned();
                $table->integer('servicio_id')->nullable()->unsigned();
                $table->integer('pais_id')->nullable()->unsigned();
                $table->integer('cantidad');
                $table->double('total', 15, 8);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('periodos');
    }
}
