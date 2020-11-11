<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditIdFctToIdFromFacturaRango extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('facturas_rango', function (Blueprint $table) {               
            $table->unsignedInteger('id_fct', 11)->charset(null)->collation(null)->change();
            $table->renameColumn('id_fct', 'id');
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
        Schema::table('facturas_rango', function (Blueprint $table) {               
            $table->renameColumn('id', 'id_fct');
        });
    }
}
