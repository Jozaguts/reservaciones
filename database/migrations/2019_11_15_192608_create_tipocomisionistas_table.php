<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipocomisionistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipocomisionistas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave');
            $table->string('nombre');
            $table->boolean('active');
            $table->boolean('remove');            
            $table->softDeletes();           

            $table->unsignedInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('usuarios');	            

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
        Schema::dropIfExists('tipocomisionistas');
    }
}
