<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave',5);
            $table->integer('cantidad')->nullable(false);
            $table->decimal('balance')->nullable(false)->default(0);
            $table->decimal('anticipo')->nullable(false)->default(0);
            $table->decimal('precio')->nullable(false)->default(0);
            $table->decimal('pago')->nullable(false)->default(0);
            $table->date('fecha')->nullable(false);
            $table->boolean('show');
            $table->integer('estado');
            $table->boolean('active');
            $table->boolean('remove');     
            $table->softDeletes();           

            $table->unsignedInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('usuarios');	            
            $table->unsignedInteger('idcliente');
            $table->foreign('idcliente')->references('id')->on('clientes');	
            $table->unsignedInteger('idcomisionista');
            $table->foreign('idcomisionista')->references('id')->on('comisionistas');	            

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
        Schema::dropIfExists('reservaciones');
    }
}
