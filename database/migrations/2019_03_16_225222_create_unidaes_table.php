<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidaesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave', 5);
            $table->string('placa');
            $table->integer('capacidad');
            $table->string('descripcion');
            $table->string('color');
            $table->boolean('active');
            $table->boolean('remove');
            $table->softDeletes();
			
            $table->unsignedInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('usuarios');			
            $table->unsignedInteger('idtipounidad');
            $table->foreign('idtipounidad')->references('id')->on('tipounidades');
			
			
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
        Schema::dropIfExists('unidaes');
    }
}
