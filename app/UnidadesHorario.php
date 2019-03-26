<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadesHorario extends Model
{
    protected $table = "unidadeshorario";

    protected $fillable =['dia','idtipounidad','hini','hfin','active','remove','idusuario'];

 
}
