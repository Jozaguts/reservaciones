<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDisponibilidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidad', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('capacidad');
            $table->integer('ocupacion');
            $table->softDeletes();

            $table->unsignedInteger('unidad_id');
            $table->foreign('unidad_id')->references('id')->on('unidades');
            $table->unsignedInteger('horario_id');
            $table->foreign('horario_id')->references('id')->on('actividadeshorarios');
            
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
        Schema::dropIfExists('disponibilidad');
    }
}
