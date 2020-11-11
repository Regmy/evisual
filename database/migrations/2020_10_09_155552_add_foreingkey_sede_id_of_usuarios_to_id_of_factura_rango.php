<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingkeySedeIdOfUsuariosToIdOfFacturaRango extends Migration
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
            $table->unsignedInteger('sede_id')->length(11)->charset(null)->collation(null)->change();
            $table->foreign('sede_id')->references('id')->on('facturas_rango');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        $table->dropForeign(['sede_id']);
        $table->string('sede_id')->change();        
        
    }
}
