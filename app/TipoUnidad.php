<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TipoUnidad extends Model
{
    use SoftDeletes; //Implementamos 
    
    protected $table = 'tipounidades';
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['nombre','combustible','medio','remove','active','idusuario'];
    
}
