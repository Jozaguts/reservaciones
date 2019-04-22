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
            $table->decimal('precio1')->nullable()->default(null);
            $table->decimal('precio2')->nullable()->default(null);
            $table->decimal('precio3')->nullable()->default(null);   
            $table->decimal('doble')->nullable()->default(null);                        
            $table->decimal('doblebalanc')->nullable()->default(null);   
            $table->decimal('triple')->nullable()->default(null);   
            $table->decimal('triplebalanc')->nullable()->default(null);   
            $table->boolean('promocion')->nullable()->default(null);
            $table->boolean('restriccion')->nullable()->default(null);//antes campo cobro
            $table->boolean('acompanante')->nullable()->default(null); //agrege campo
            $table->boolean('active');
            $table->boolean('remove');
            $table->timestamps();

            $table->unsignedInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('usuarios');	
            $table->unsignedInteger('persona_id'); //se agrego campo FK
            $table->foreign('persona_id')->references('id')->on('personas');		            
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
