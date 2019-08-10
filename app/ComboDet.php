<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class ComboDet extends Model
{
    use SoftDeletes; //Implementamos 
    protected $table = 'combo_det';
    protected $dates = ['deleted_at'];

    protected $fillable = ['hini','hfin','actividades_id', 'actividades_id_combo','horario_id','usuarios_id','active','remove'];

    //
}
