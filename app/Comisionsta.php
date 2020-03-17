<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comisionsta extends Model
{
    protected $table= "comisionistas";

    protected $fillable = [
        'clave',
        'nombre',
        'empleado',
        'facturable',
        'whats',
        'movil',
        'telefono',
        'email',
        'fecnac',
        'active',
        'remove',
        'idusuario',
        'idtipocomisionista'
    ];


    protected $attributes = [
        'remove' => false,
        'active'=>true
    ];
}
