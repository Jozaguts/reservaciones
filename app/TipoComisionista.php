<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TipoComisionista extends Model
{
    protected $table="tipocomisionistas";
    protected $fillable = ['idusuario', 'clave', 'nombre'];
}
