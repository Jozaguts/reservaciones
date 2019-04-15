<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadpreciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividadprecios', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precio1');
            $table->decimal('precio2');
            $table->decimal('precio3');   
            $table->decimal('doble');                        
            $table->decimal('doblebalanc');   
            $table->decimal('triple');   
            $table->decimal('triplebalanc');   
            $table->boolean('promocion');
            $table->boolean('cobro');
            $table->boolean('active');
            $table->boolean('remove');

            $table->unsignedInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('usuarios');		            
            // $table->unsignedInteger('pases_id');
            // $table->foreign('pases_id')->references('id')->on('pases');		            
            $table->unsignedInteger('actividades_id');
            $table->foreign('actividades_id')->references('id')->on('actividades');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividadprecios');
    }
}
