<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50)->nullable(false);
            $table->string('direccion', 120)->nullable(false);
            $table->string('telefono', 30)->nullable(false);
            $table->string('correo', 30)->nullable(false);
            $table->string('pais', 25)->nullable(false);
            $table->string('ciudad', 25)->nullable(false);
            $table->string('estado', 25)->nullable(false);
            $table->string('nacionalidad', 25)->nullable(false);
            $table->string('contacto', 50)->nullable(false);
            $table->string('telcontacto', 25)->nullable(false);
            $table->boolean('remove');
            $table->softDeletes();

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
        Schema::dropIfExists('clientes');
    }
}
