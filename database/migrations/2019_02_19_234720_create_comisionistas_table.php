<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComisionistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comisionistas', function (Blueprint $table) {
            $table->increments('idcomsionista');
            $table->string('clave', 4);            
            $table->string('nombre', 45);            
            $table->string('apellidos', 45);
            $table->string('direccion');
            $table->decimal('sueldo', 16,2);
            $table->integer('estado');                    
            $table->timestamps();
//            $table->foreign('idusuario')->references('idusuario')->on('usuario');            
//            $table->foreign('idtipocomisionista')->references('idtipocomisionista')->on('comisionistas');
//            $table->foreign('idempresa')->references('idempresa')->on('empresas');            
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
        Schema::dropIfExists('comisionistas');
    }
}
