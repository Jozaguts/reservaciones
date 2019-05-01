<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadhorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividadhorarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dia',1);
            $table->time('hini')->nullable(); 
            $table->time('hfin')->nullable();
            $table->boolean('active');
            $table->boolean('remove');

            $table->unsignedInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('usuarios');	

            $table->unsignedInteger('actividades_id');
            $table->foreign('actividades_id')->references('id')->on('actividades');
            

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
        Schema::dropIfExists('actividadhorarios');
    }
}
