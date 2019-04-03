<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TipoActividades extends Model
{
    use SoftDeletes; //Implementamos 

    protected $table = 'tipoactividades';
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['nombre','color','clave','remove','active','usuarios_id'];  
}