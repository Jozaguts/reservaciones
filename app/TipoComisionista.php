<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TipoComisionista extends Model
{
    use SoftDeletes; 
    protected $dates = ['deleted_at'];
    protected $attributes = [
        'remove' => false,
        'active'=>true
    ]; 
    protected $table = 'tipocomisionistas';
    protected $fillable = ['idusuario', 'clave', 'nombre', 'active', 'remove'];
}
