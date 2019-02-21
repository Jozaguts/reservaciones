<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('idempresa');
            $table->string('nombre',255);
            $table->string('direccion',255);
            $table->string('telefono', 15);
            $table->string('contacto', 100);
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
        Schema::dropIfExists('empresas');
    }
}
