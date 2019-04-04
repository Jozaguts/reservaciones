<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoactiviadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoactividades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave',5);
            $table->string('nombre');
            $table->string('color');
            $table->unsignedInteger('tipounidad_id');
            $table->boolean('active',1);
            $table->boolean('remove');
            $table->softDeletes();            

            $table->unsignedInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('usuarios'); 
            $table->foreign('tipounidad_id')->references('id')->on('tipounidades');             

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
        Schema::dropIfExists('tipoactiviades');
    }
}
