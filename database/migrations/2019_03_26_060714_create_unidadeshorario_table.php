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
            $table->integer('idtipounidad');
            $table->string('dia');
            $table->time('hini');
            $table->time('hfin');
            $table->boolean('active');
            $table->boolean('remove');
            $table->integer('idusuario');
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
