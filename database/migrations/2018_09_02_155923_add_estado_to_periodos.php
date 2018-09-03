<?php

use Illuminate\Database\Migrations\Migration;

class AddEstadoToPeriodos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periodos', function($table)
        {
            $table->enum('estado', ['pendiente', 'listo'])->after('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periodos', function($table)
        {
            $table->dropColumn('estado');
        });
    }
}
