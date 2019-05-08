<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalidasLlegadas extends Model
{
   protected $table= "salidallegadas";

   protected $fillable = ['clave','nombre','direccion','kml','active','remove','usuarios_id','longitud',
   'latitud','frame'];  

   
}
