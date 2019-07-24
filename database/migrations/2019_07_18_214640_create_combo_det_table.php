<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComboDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_det', function (Blueprint $table) {
            $table->increments('id');
            
            $table->time('hini')->nullable();
            $table->time('hfin')->nullable();  

            $table->unsignedInteger('actividades_id');
            $table->foreign('actividades_id')->references('id')->on('actividades');

            $table->unsignedInteger('actividades_id_combo');
            $table->foreign('actividades_id_combo')->references('id')->on('actividades');

            $table->unsignedInteger('horario_id');
            $table->foreign('horario_id')->references('id')->on('actividadeshorarios');
      

    
            $table->unsignedInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('usuarios');
            
            $table->boolean('active');
            $table->boolean('remove');	


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
        Schema::dropIfExists('combo_det');
    }
}
