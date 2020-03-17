<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComisionistaDet extends Model
{
    protected $table= 'comisionistadet';
    protected $fillable=[
    'porcentaje'
    'importe'
    'cupon'
    'meta'
    'precio'
    'idusuario'
    'idcomisionista'
    'idactividad'
    ];

    // $table->increments('id');
    // $table->integer('porcentaje');
    // $table->decimal('importe');
    // $table->integer('cupon');
    // $table->integer('meta');
    // $table->integer('precio');
    // $table->softDeletes();

    // $table->unsignedInteger('idusuario');
    // $table->foreign('idusuario')->references('id')->on('usuarios');
    // $table->unsignedInteger('idcomisionista');
    // $table->foreign('idcomisionista')->references('id')->on('comisionistas');
    // $table->unsignedInteger('idactividad');
    // $table->foreign('idactividad')->references('id')->on('actividades');
}
