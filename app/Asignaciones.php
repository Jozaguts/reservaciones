<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
    protected $table = "asignaciones";
    
    protected $fillable = ['actividad_id','actividad_horario_id','unidad_id','salida','salida_llegada_id'];

}
