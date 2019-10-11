<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadesHorario extends Model
{
    protected $table =  "actividadeshorarios";
    
    protected  $fillable = ['hini','hfin','l','m','x','j','v','s','d','active','remove','actividades_id','actividades_id','usuarios_id','usuarios_id','libre'];



    public function actividad()
{
    
    return $this->belongsTo('App\Actividades','actividades_id');
}
}


