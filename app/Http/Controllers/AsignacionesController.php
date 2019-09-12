<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquiposYUnidades;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Enginges\EloquentEngine;


class AsignacionesController extends Controller
{
   public function index(Request $request){
 

    return view('sections.activities.asignaciones');
    
   }


   public function getAsignaciones(Request $request){

      // $unidades = EquiposYUnidades::select(['id','clave','active','capacidad']);
      $uni = DB::table('unidades as un')
      ->join('tipounidades as tun', 'un.idtipounidad', '=', 'tun.id')
      ->select('un.id','un.clave', 'un.descripcion as Unidad', 'tun.id as tunid','tun.nombre as tipo_unidad', 'un.capacidad', DB::raw('IF(un.active=1, "Activo", "Desactivo") as status'))
      ->where([['un.remove', '=', '0']])
      ->get();
      // Datatables::eloquent($model)->make(true);
      return Datatables::of($uni)->make(true);
      // return Datatables::of( EquiposYUnidades::select(['id','descripcion','clave','active','capacidad']))
      

   }
}



