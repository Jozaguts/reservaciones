<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservacionesdispersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservacionesdispersion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45)->nullable(false);            
            $table->integer('edad');
            $table->string('telefono', 25)->nullable(false);
            $table->decimal('balance')->nullable(false)->default(0);
            $table->decimal('anticipo')->nullable(false)->default(0);
            $table->decimal('precio')->nullable(false)->default(0);
            $table->decimal('pago')->nullable(false)->default(0);
            $table->softDeletes();           

            $table->unsignedInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('usuarios');	            
            $table->unsignedInteger('idreservaciondet');
            $table->foreign('idreservaciondet')->references('id')->on('reservacionesdet');	            
            $table->unsignedInteger('idpersona');
            $table->foreign('idpersona')->references('id')->on('personas');	            
            
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
        Schema::dropIfExists('reservacionesdispersion');
    }
}
