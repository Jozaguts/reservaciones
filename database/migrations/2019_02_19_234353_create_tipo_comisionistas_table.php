<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoComisionistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipocomisionistas', function (Blueprint $table) {
            $table->increments('idtipocomisionista');
            $table->string('nombre',50);
            $table->integer('estado');
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('idusuario')->on('usuario');
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
        Schema::dropIfExists('tipo_comisionistas');
    }
}
