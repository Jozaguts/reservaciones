<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadeshorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidadeshorario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dia');
            $table->time('hini')->nullable();
            $table->time('hfin')->nullable();
            $table->boolean('active');
            $table->boolean('remove');
            $table->softDeletes();

            $table->unsignedInteger('unidades_id');
            $table->foreign('unidades_id')->references('id')->on('unidades');			            
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
        Schema::dropIfExists('unidadeshorario');
    }
}
