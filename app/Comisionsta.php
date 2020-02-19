<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comisionsta extends Model
{
    protected $table= "comisionistas";
    protected $attributes = [
        'remove' => false,
        'active'=>true
    ];
}
