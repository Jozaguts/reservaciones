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
        'actividadeshorario_id'
    ];


}
