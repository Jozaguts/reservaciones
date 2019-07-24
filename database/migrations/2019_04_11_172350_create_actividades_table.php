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
            $table->string('clave',5);
            $table->string('nombre',40);
            $table->decimal('precio',16,4);
            $table->decimal('balance',16,4);        
            $table->boolean('fijo');
            $table->boolean('renta');
            $table->integer('minutoincrementa')->nullable();
            // $table->integer('minutosincluidos')->nullable();//agregue este campo a la db
            $table->double('montoincremento')->nullable();
            $table->boolean('promocion');
            $table->boolean('combo');
            $table->string('observaciones')->nullable();//4ta pestaña
            $table->string('requisitos')->nullable(); //4ta pestaña
            $table->integer('maxcortesias')->nullable();
            $table->integer('duracion')->nullable();
            $table->integer('maxcupones')->nullable();
            $table->boolean('riesgo');      //cambio de string a boolean
            $table->integer('puntos')->nullable();  //4ta pestaña
            $table->boolean('mismo_dia')->default('1');//default true
            $table->boolean('libre');
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