<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    use SoftDeletes; //Implementamos 
  
    protected $table = 'actividades';
    protected $dates = ['deleted_at'];

    protected $fillable = ['clave','nombre','precio', 'balance','fijo','renta','minutoincrementa','montoincremento','promocion','combo','observaciones','requisitos','maxcortesias','maxcupones','riesgo','puntos','active','remove','tipounidades_id'];

  
    public function TipoUnidad()
    {
        return $this->belongsTo(TipoUnidad::class,'tipounidades_id');
    }

    public function TipoActividad(){
        return $this->belongsTo(TipoActividades::class,'tipoactividades_id');
    }


}
