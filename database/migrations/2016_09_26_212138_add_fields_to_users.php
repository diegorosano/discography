<?php

use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsers extends Migration
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
                $table->enum('rol', ['administrador', 'miembro'])->after('password');
                $table->integer('banda_id')->nullable()->after('rol')->unsigned();
                $table->string('avatar')->after('banda_id');
                $table->enum('estado', ['activo', 'no activo'])->after('avatar');
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
                $table->dropColumn('rol');
                $table->dropColumn('banda_id');
                $table->dropColumn('avatar');
                $table->dropColumn('estado');
            });
    }
}
