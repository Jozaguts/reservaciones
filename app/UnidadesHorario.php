<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class UnidadesHorario extends Model
{
    use SoftDeletes; //Implementamos 
    protected $table = "unidadeshorario";
     protected $dates = ['deleted_at'];

    protected $fillable =['dia','idtipounidad','hini','hfin','active','remove','idusuario','unidades_id'];

   
}
