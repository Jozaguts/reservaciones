<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservacionesdetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservacionesdet', function (Blueprint $table) {
            $table->increments('id');
            $table->time('hini')->nullable();
            $table->time('hfin')->nullable();
            $table->date('fecha')->nullable(false);
            $table->string('clave',5)->nullable(false);
            $table->integer('folio');
            $table->decimal('balance')->nullable(false)->default(0);
            $table->decimal('anticipo')->nullable(false)->default(0);
            $table->decimal('precio')->nullable(false)->default(0);
            $table->decimal('pago')->nullable(false)->default(0);
            $table->boolean('show');
            $table->softDeletes();           

            $table->unsignedInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('usuarios');	            
            $table->unsignedInteger('idreservacion');
            $table->foreign('idreservacion')->references('id')->on('reservaciones');	            
            $table->unsignedInteger('idactividad');
            $table->foreign('idactividad')->references('id')->on('actividades');	            
            $table->unsignedInteger('idactividadhorario');
            $table->foreign('idactividadhorario')->references('id')->on('actividadeshorarios');	            
            $table->unsignedInteger('idunidad');
            $table->foreign('idunidad')->references('id')->on('unidades');	            
            $table->unsignedInteger('idpersona');
            $table->foreign('idpersona')->references('id')->on('personas');	            
            $table->unsignedInteger('idsalida');
            $table->foreign('idsalida')->references('id')->on('salida_llegadahorarios');	            
            $table->unsignedInteger('idllegada');
            $table->foreign('idllegada')->references('id')->on('salida_llegadahorarios');	            
            



            



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
        Schema::dropIfExists('reservacionesdet');
    }
}
