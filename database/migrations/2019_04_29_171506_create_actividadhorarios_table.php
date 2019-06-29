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
        Schema::create('actividadeshorarios', function (Blueprint $table) {
            $table->increments('id');
            $table->time('hini')->nullable();
            $table->time('hfin')->nullable();            
            $table->boolean('l');
            $table->boolean('m');
            $table->boolean('x');
            $table->boolean('j');
            $table->boolean('v');
            $table->boolean('s');
            $table->boolean('d');
            $table->timestamps();
            $table->boolean('active');
            $table->boolean('libre');
            $table->boolean('remove');                   

            $table->unsignedInteger('actividades_id');
            $table->foreign('actividades_id')->references('id')->on('actividades');
            
            $table->unsignedInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('usuarios');		                    
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
