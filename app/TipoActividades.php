<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 


class TipoActividades extends Model
{
    use SoftDeletes; //Implementamos 
    protected $table = 'tipoactividades';
    
    protected $attributes = [
        'remove' => false,
        'active'=>true
    ]; 
   

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['nombre','color','clave','remove','active','usuarios_id','tipounidad_id']; 
    
   

    public function TipoUnidad(){
        return $this->belongsTo(TipoUnidad::class,'tipounidad_id');
    }

    public function Actividades(){
        return $this->hasMany(Actividades::class,'tipoactividades_id');
    }
}