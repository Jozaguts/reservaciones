<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquiposYUnidades;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Traits\Infoactividad;
use App\Actividades;
use App\ActividadesHorario;
use Carbon\Carbon;
use App\Http\Requests\StoreAsiginaciones;
use App\Asignaciones;



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

    public function store(StoreAsiginaciones $request) {

      $asingaciones = $request->all();
      
      foreach ($asingaciones as $asingacion) {
         DB::table('asignaciones')->insert($asingacion);
      }
      
      return response()->json(['success'=> 'Asignacion Guardada Correctamente']);

    }

   public function getAsignaciones(){
    
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
    
      $horario = DB::table('actividadeshorarios as ah')
      ->join('salida_llegadahorarios as slh', 'ah.id', '=', 'slh.actividadeshorario_id')
      ->join('salidallegadas as sl', 'slh.salidallegadas_id', '=', 'sl.id')
      ->select('ah.id as horario_id', 'slh.id as sal_lleg_hor_id', 'slh.hora', DB::raw('IF(slh.salida=1, "S", "Ll") as tipo'), 'sl.id as sal_lleg_id', 'sl.nombre as punto')
      ->where([['ah.id','=',$id]])
      ->get();
      return response()->json(['info'=> $horario]);
    
   }
  


}



