<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidallegadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidallegadas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave',4);
            $table->string('nombre',40);
            $table->string('direccion',40);   
            $table->string('kml');
            $table->string('longitud');
            $table->string('latitud');
            $table->longText('frame');
            $table->boolean('active');
            $table->boolean('remove');
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
        Schema::dropIfExists('salidallegadas');
    }
}
