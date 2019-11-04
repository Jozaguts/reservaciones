<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('actividad_id');
            $table->foreign('actividad_id')->references('id')->on('actividades');

            $table->unsignedInteger('actividad_horario_id');
            $table->foreign('actividad_horario_id')->references('id')->on('actividadeshorarios');

            $table->unsignedInteger('unidad_id');
            $table->foreign('unidad_id')->references('id')->on('unidades');

            
            $table->unsignedInteger('salida_llegada_id');
            $table->foreign('salida_llegada_id')->references('id')->on('salida_llegadahorarios');

            $table->boolean('salida');

            $table->softDeletes();
          
            // $table->unsignedInteger('salida_llegada_id');
            // $table->foreign('salida_llegada_id')->references('id')->on('unidades'); 

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
        Schema::dropIfExists('asignaciones');
    }
}
