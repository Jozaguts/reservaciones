<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combos extends Model
{
    protected $table = "combo_det";

    protected $fillable =['hini',"hfin","actividades_id_combo","horario_id","actividades_id","active","remove","usuarios_id",];
    
}
