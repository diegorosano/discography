<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discos', function (Blueprint $table)
            {
                $table->increments('id');
                $table->string('nombre');
                $table->integer('anio');
                $table->integer('banda_id')->nullable()->unsigned();
                $table->string('portada');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discos');
    }
}
