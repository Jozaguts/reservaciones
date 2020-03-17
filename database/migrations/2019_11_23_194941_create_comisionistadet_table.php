<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComisionistadetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comisionistadet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('porcentaje');
            $table->decimal('importe');
            $table->integer('cupon');
            $table->integer('meta');
            $table->integer('precio');
            $table->softDeletes();

            $table->unsignedInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('usuarios');
            $table->unsignedInteger('idcomisionista');
            $table->foreign('idcomisionista')->references('id')->on('comisionistas');
            $table->unsignedInteger('idactividad');
            $table->foreign('idactividad')->references('id')->on('actividades');

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
        Schema::dropIfExists('comisionistadet');
    }
}
