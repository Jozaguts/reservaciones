<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquiposYUnidades;
use Yajra\Datatables\Datatables;
// use Yajra\Datatables\Facades\Datatables;


class AsignacionesController extends Controller
{
   public function index(Request $request){
 

    return view('sections.activities.asignaciones');
    
   }


   public function getAsignaciones(Request $request){

      // $unidades = EquiposYUnidades::select(['id','clave','active','capacidad']);
      return Datatables::of( EquiposYUnidades::select(['id','clave','active','capacidad']))
      ->make(true);

   }
}



