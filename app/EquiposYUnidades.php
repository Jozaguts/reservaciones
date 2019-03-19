<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class EquiposYUnidades extends Model
{
    use SoftDeletes; //Implementamos 
    protected $table = 'unidades';
    
    protected $dates = ['deleted_at'];
   
    protected $fillable = ['clave','placa','capacidad','descripcion','remove','active','color','idusuario','idtipounidad']; 
  
}
