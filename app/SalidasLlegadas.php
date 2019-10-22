<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalidasLlegadas extends Model
{
   protected $table= "salidallegadas";

   protected $fillable = ['clave','nombre','direccion','kml','active','remove','usuarios_id','longitud',
   'latitud','frame'];  

   public function salidaLlegadaHorarios(){

   return $this->belongsToMany('App\SalidasLlegadas','salidas_llegadas_salidas_llegadas_horario','sl_id', 'slh_id')->withTimestamps();
}
   
}
