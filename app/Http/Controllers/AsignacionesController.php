<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquiposYUnidades;


class AsignacionesController extends Controller
{
   public function index(){

    $unidades=EquiposYUnidades::all();
    return view('sections.activities.asignaciones',compact('unidades'));
   }
}
