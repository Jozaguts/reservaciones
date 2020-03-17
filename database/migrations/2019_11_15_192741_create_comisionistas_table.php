<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComisionistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comisionistas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave',5);
            $table->string('nombre', 45)->nullable(false);
            $table->boolean('empleado');
            $table->boolean('facturable');
            $table->string('whats')->nullable(false);
            $table->string('movil')->nullable(false);
            $table->string('telefono')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('fecnac')->nullable(false);

            $table->boolean('active');
            $table->boolean('remove');
            $table->softDeletes();

            $table->unsignedInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('usuarios');
            $table->unsignedInteger('idtipocomisionista');
            $table->foreign('idtipocomisionista')->references('id')->on('tipocomisionistas');

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
        Schema::dropIfExists('comisionistas');
    }
}
