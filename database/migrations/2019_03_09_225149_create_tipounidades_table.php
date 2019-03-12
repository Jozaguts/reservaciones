<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipounidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipounidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('combustible');
            $table->string('medio');
            $table->boolean('remove');
            $table->boolean('active');
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
        Schema::dropIfExists('tipounidades');
    }
}
