<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalidasLlegadasHorario extends Model
{
    protected $table ="salida_llegadahorarios";
    protected $fillable =[
        'hora',
        'salida',
        'active',
        'remove',                   
        'salidallegadas_id',       
        'usuarios_id',
        'actividadeshorario_id',
     
    ];

    public function salidaLlegadas(){
        // llaves a la inversa para el otro modelo
        return $this->belongsToMany('App\SalidasLlegadas','salidas_llegadas_salidas_llegadas_horario','slh_id','sl_id')->withTimestamps();
    }
}
