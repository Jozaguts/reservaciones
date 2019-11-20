<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ActividadesHorario;
use App\Actividades;
use App\TipoActividades;
use Carbon\Carbon;


class ReservacionesController extends Controller
{
    public function index(){
        return view('sections.reservations');
    }

   public function dashboard(){
    $horario= DB::table('actividades as ac')
    ->join('actividadeshorarios as ah', 'ac.id', '=', 'ah.actividades_id')
    ->join('tipoactividades as ta', 'ta.id', '=', 'ac.tipoactividades_id')
    ->select('ac.id as actividadid', 'ac.nombre as name', DB::raw('concat(ac.clave, " | ", ac.nombre)  as details'), DB::raw('concat(curdate(), " ", SUBSTRING(ah.hini,1,5)) as start'), DB::raw('concat(curdate(), " ", SUBSTRING(ah.hfin,1,5)) as end'), 'ta.color', DB::raw('curdate()'))
    ->where([['ac.active', '=', '1'], ['ah.active', '=', '1'], [DB::raw('ELT(WEEKDAY(curdate()) + 1, l, m, x, j, v, s, d)'), '=', '1']])
    ->get();
    // dd($horario);
    return response()->json(['horario' =>$horario]);

    // // $date = Carbon::now('America/Mexico_City');

    // // $dia_de_la_semana = $date->toDateString();
    // // dd($dia_de_la_semana);

    // // $dia_a_buscar="";
    // //     switch ($dia_de_la_semana) {
    // //         case 1:
    // //             $dia_a_buscar= "l";
    // //             break;
    // //         case 2:
    // //             $dia_a_buscar= "m";
    // //             break;
    // //         case 3:
    // //             $dia_a_buscar= "x";
    // //             break;
    // //         case 4:
    // //             $dia_a_buscar= "j";
    // //             break;
    // //         case 5:
    // //             $dia_a_buscar= "v";
    // //             break;
    // //         case 6:
    // //             $dia_a_buscar= "s";
    // //             break;
    // //         case 7:
    // //             $dia_a_buscar= "d";
    // //             break;     
    // //     }
    // //     // Actividades horarios del día
    // //     $actividadesHorarios = DB::table('actividadeshorarios')
    // //     ->select('hini','hfin','id','active','actividades_id')
    // //     ->where('active',1)
    // //     ->where($dia_a_buscar,1)
    // //     ->get();

    // //     // // actividades activas de los horarios del día
    // //     $actividades = array();
    // //     $infoActividad=array();
    // //     foreach($actividadesHorarios as $a_horario){

    // //         $actividad = DB::table('actividades')
    // //         ->select('id','clave', 'nombre')
    // //         ->where('active',1)
    // //         ->where('id',$a_horario->actividades_id)
    // //         ->get();

    // //         $actividades[]=$actividad;

    // //     }
    // //     foreach($actividades as $actividad){


    // //         $infoActividad=[
    // //             'name' => ,
    // //             details: 'Testing',
    // //             start: '2019-01-03',
    // //             end: '2019-01-07',
    // //             color: 'cyan',
    // //         ]    
    // //     }
      
        

    
    
    // $tipoActividades = DB::table('tipoactividades')
    // ->select('nombre', 'color','id')
    // ->get();
    // $info = [];
   
    // foreach ($tipoActividades as $tipoActividad) {
    //     $actividades = Actividades::all()
    //     ->where('tipoactividades_id', $tipoActividad->id);

    //     foreach($actividades as $actividad){

    //         $horarios = Actividades::find( $actividad->id)
    //         ->horarios()
    //         ->get();
          
           
    //         foreach($horarios as $horario){
    //             $l="";$m="";$x="";$j="";$v="";$s="";$d="";
    //             $horario->l == 1 ? $l="Lunes":$l=""; 
    //             $horario->m == 1 ? $m="Martes":$m=""; 
    //             $horario->x == 1 ? $x="Miércoles":$x=""; 
    //             $horario->j == 1 ? $j="Jueves":$j=""; 
    //             $horario->v == 1 ? $v="Viernes":$v=""; 
    //             $horario->s == 1 ? $s="Sábado":$s=""; 
    //             $horario->d == 1 ? $d="Domingo":$d=""; 


    //             // dd($l,$m , $horario->l);

    //             $infoActividad = [
    //                 'color'=> $tipoActividad->color,
    //                 'details' => " $actividad->clave | $actividad->nombre | <br> $l $m $x $j $v $s $d <br>
    //                  Hora Inicio: $horario->hini <br> Hora Fin $horario->hfin",
    //                 'end' => $date->addDay()->format('Y-m-d'),
    //                 'start' => $date->format('Y-m-d'),
    //                 'name'=> "$actividad->nombre ",
    //                 'horario_id' =>  $horario->id,
    //                 'actividad_id' => $actividad->id 
    
    //                 // 'tipo_actividad_id'=> $tipoActividad->id,
    //                 // 'tipo_actividad_nombre'=> $tipoActividad->nombre,
    //                 // 'actividad_id' => $actividad->id,
    //                 // 'actividad_clave'=> $actividad->clave,
    //                 // 'actividad_nombre'=>$actividad->nombre,
    //                 // 'actividad_horarios'=> $horarios  
    //             ];
    //             $info[]=$infoActividad;
    //         }
          

           

           
    //     }
       
      
    // }

  
    //    return response()->json([
    //         'tipo_actividades' => $tipoActividades,
    //         'actividades'=>$info 
    //     ]);
   }
}
