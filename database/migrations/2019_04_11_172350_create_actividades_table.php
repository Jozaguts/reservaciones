<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave',4);
            $table->string('nombre',40);
            $table->decimal('precio',16,4);
            $table->decimal('balance',16,4);        
            $table->boolean('fijo');
            $table->boolean('renta');
            $table->integer('minutoincrementa');
            $table->integer('minutosincluidos');//agregue este campo a la db
            $table->double('montoincremento');
            $table->boolean('promocion');
            $table->boolean('combo');
            $table->string('observaciones');
            $table->string('requisitos');
            $table->integer('maxcortesias');
            $table->integer('maxcupones');
            $table->string('riesgo', 45);      
            $table->integer('puntos');  
            $table->boolean('active');
            $table->boolean('remove');     
            $table->softDeletes();           

            $table->unsignedInteger('idusuario');
            $table->foreign('idusuario')->references('id')->on('usuarios');			
            $table->unsignedInteger('tipoactividades_id');
            $table->foreign('tipoactividades_id')->references('id')->on('tipoactividades');
            $table->unsignedInteger('tipounidades_id');
            $table->foreign('tipounidades_id')->references('id')->on('tipounidades');
            $table->unsignedInteger('anticipo_id');
            $table->foreign('anticipo_id')->references('id')->on('anticipos');
                        

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
        Schema::dropIfExists('actividades');
    }
}