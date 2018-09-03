<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkAssociations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table)
            {
                $table->foreign('banda_id')->references('id')->on('bandas')->onDelete('set null');
            });
        Schema::table('discos', function($table)
            {
                $table->foreign('banda_id')->references('id')->on('bandas')->onDelete('set null');
            });
        Schema::table('periodos', function($table)
            {
                $table->foreign('banda_id')->references('id')->on('bandas')->onDelete('set null');
                $table->foreign('disco_id')->references('id')->on('discos')->onDelete('set null');
                $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('set null');
                $table->foreign('pais_id')->references('id')->on('paises')->onDelete('set null');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
            {
                $table->dropForeign();
            });
    }
}
