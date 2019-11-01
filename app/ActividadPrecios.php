<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadPrecios extends Model
{

    protected $table = 'actividadprecios';
    
    protected $fillable = [
    'precio1',
    'precio2',
    'precio3',
    'doble',
    'doblebalanc',
    'triple',
    'triplebalanc',
    'promocion',
    'restriccion',
    'active',
    'acompanante',
    'remove',
    'persona_id',
    'usuario_id',
    'pases_id',
    'actividad_id'
];
 


   
}
