<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidasllegadaSalidaLlegadahorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas_llegadas_salidas_llegadas_horario', function (Blueprint $table) {
            $table->engine = 'innoDB';
            $table->increments('id');
            $table->unsignedInteger('sl_id');
            $table->unsignedInteger('slh_id');

            $table->foreign('sl_id')->references('id')->on('salidallegadas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                $table->timestamps();
                $table->foreign('slh_id')->references('id')->on('salida_llegadahorarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salidasllegada_salida_llegadahorario');
    }
}
