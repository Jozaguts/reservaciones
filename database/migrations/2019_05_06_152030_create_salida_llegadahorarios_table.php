<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidaLlegadahorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_llegadahorarios', function (Blueprint $table) {
            $table->increments('id');
            $table->time('hora')->nullable();
            $table->boolean('salida');//se agrego este campo

            $table->boolean('active');
            $table->boolean('remove');                   

            $table->unsignedInteger('salidallegadas_id');
            $table->foreign('salidallegadas_id')->references('id')->on('salidallegadas');

            $table->unsignedInteger('actividadeshorario_id');
            $table->foreign('actividadeshorario_id')->references('id')->on('actividadeshorarios');	
            		        
            $table->unsignedInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('usuarios');
       		        

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
        Schema::dropIfExists('salida_llegadahorarios');
    }
}
