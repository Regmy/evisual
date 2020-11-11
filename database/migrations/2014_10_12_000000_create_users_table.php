<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('documento')->unique();
            $table->string('contrasena');
            $table->string('rol');
            $table->string('sede');
            $table->string('nivelacceso');
            $table->string('email')->unique();
            $table->string('email_verified_at');            
            $table->rememberToken();
            $table->timestamps();
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* Schema::dropIfExists('usuarios'); */
    }
}
