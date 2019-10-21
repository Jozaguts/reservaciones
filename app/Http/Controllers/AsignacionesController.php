<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquiposYUnidades;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Traits\Infoactividad;
use App\Actividades;



class AsignacionesController extends Controller
{
   use  Infoactividad;

   public function index(Request $request){
 
    return view('sections.activities.asignaciones');
    
   }

   public function show($id){
      $unidad = DB::table('unidades as u')
      ->join('tipounidades as tu', 'u.idtipounidad', '=', 'tu.id')
      ->select('u.id','u.clave','u.descripcion as nombre','u.capacidad','u.active as status','u.placa', 'tu.nombre as tipo_unidad')
      ->where('u.id','=',$id)
      ->first();
      $actividades = Actividades::all()
      ->where('combo','0');
     return response()->json(['unidadInfo'=> $unidad, 'actividades'=> $actividades]);
   }

  /*       CLAVE: ->unidades(clave) 
      UNIDAD: ->unidades(descripcion)
      UNIDAD TIPO: ->tipounidades(nombre)
      CAPACIDAD: ->unidades(capacidad)
      STATUS: ->unidades(|active=1 ACTIVO | active =0 DESACTIVADO|)
      botones de accion.      
    */ 

   public function getAsignaciones(Request $request){
    
      $unidades = DB::table('unidades as u')
      ->join('tipounidades as tu', 'u.idtipounidad', '=', 'tu.id')
      ->select('u.id','u.clave','u.descripcion as unidad','u.capacidad','u.active as status',  'tu.nombre as nombre')
      ->get();
    
     
      return Datatables::of($unidades)->make(true);
      
   }
   public function actividadHorarioInfo($id){
    
      $infoActividadHorario = new AsignacionesController;
      $info = $infoActividadHorario->getInfoactividad($id);

      return response()->json(['optionsHorario'=> $info]);
   }  

   public function salidasLlegadas($id){
      dd($id);
   }
  


}



