<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anticipos extends Model
{
    protected $table = 'anticipos';
    protected $fillable = ['nombre','porcentaje','active','remove','usuarios_id'];

}
