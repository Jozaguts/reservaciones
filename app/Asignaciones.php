<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Asignaciones extends Model
{
    use SoftDeletes; //Implementamos 
    protected $dates = ['deleted_at'];
    
    protected $table = "asignaciones";
    
    protected $fillable = ['actividad_id','actividad_horario_id','unidad_id','salida','salida_llegada_id'];

    public function unidad()
    {
        return $this->belongsTo('App\EquiposYUnidades', 'asignacion_id');
    }
}

