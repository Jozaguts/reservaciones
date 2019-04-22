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
    'usuarios_id',
    'pases_id',
    'actividades_id'
];
 


   
}
