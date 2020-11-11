<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSedeToSedeIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('usuarios', function (Blueprint $table) {
            $table->renameColumn('sede', 'sede_id');            
        });
        /* $table->unsignedInteger('sede_id')->change();
            $table->foreign('sede_id')->references('id')->on('facturas_rango'); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('usuarios', function (Blueprint $table) {
            $table->renameColumn('sede_id', 'sede');
            
        });

    }
}
