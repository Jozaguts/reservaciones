<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisponibilidaddet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidaddet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cant');
            $table->softDeletes();

            $table->unsignedInteger('disponibilidad_id');
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidad');
            $table->unsignedInteger('reservacionesdet_id');
            $table->foreign('reservacionesdet_id')->references('id')->on('reservacionesdet');


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
        Schema::dropIfExists('disponibilidaddet');
    }
}
