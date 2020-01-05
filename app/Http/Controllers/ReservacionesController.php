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

   public function dashboard(Request $request){

    $day =$request->params['day'];
    $carbaoDay = Carbon::createFromFormat('Y-m-d', $day);
    $lunes = $carbaoDay->startOfWeek()->format('Y-m-d');
    $week = array();
        for ($i=0; $i <7 ; $i++) {
            $week[] = $carbaoDay->startOfWeek()->addDay($i)->format('Y-m-d');
        }
    $horarios = array();
    $libre_icon ="<i class='libre_icon'></i>";
    $ocupacion_icon ="<i class='ocupacion_icon'></i>";
    $show_icon ="<i class='show_icon'></i>";
    $noshow_icon ="<i class='noshow_icon'></i>";
        foreach ($week as $day ) {

            $horario = DB::table('actividades as ac')
                    ->join('actividadeshorarios as ah', 'ac.id', '=', 'ah.actividades_id')
                    ->join('tipoactividades as ta', 'ta.id', '=', 'ac.tipoactividades_id')
                    ->leftJoin('asignaciones as asi', 'ah.id', '=', 'asi.actividad_horario_id')
                    ->leftJoin('unidades as uni', 'asi.unidad_id', '=', 'uni.id')
                    ->leftJoin('disponibilidad as dis', function($join){
                            $join->on('ah.id', '=', 'dis.horario_id');
                            $join->on('uni.id', '=', 'dis.unidad_id');
                    })
                    ->select('ac.id as actividadid',
                        DB::raw('concat(ac.clave, " | ", ac.nombre)  as name'),
                        DB::raw('concat("'.$ocupacion_icon.'",  SUM(IFNULL(dis.ocupacion,0)),"'.$libre_icon.'",SUM(IFNULL(uni.capacidad,0)) -  SUM(IFNULL(dis.ocupacion,0)),"'.$show_icon.'0","'.$noshow_icon.'0")  as details'),
                        DB::raw('concat("'.$day.'", " ", SUBSTRING(ah.hini,1,5)) as start'),
                        DB::raw('concat("'.$day.'") as end'),'ta.color')
                        ->where([['ac.active', '=', '1'], ['ah.active', '=', '1'], ['asi.salida', '=','1'], [DB::raw('ELT(WEEKDAY("'.$day.'") + 1, l, m, x, j, v, s, d)'), '=', '1']])
                        ->groupBy('ac.id', 'ac.clave', 'ac.nombre', 'ah.hini', 'ta.color')
                        ->get();
            $horarios[]=$horario;
        }
    return response()->json(['horario' =>array_flatten($horarios)]);
   }

   public function getActividades(Request $request) {
       if($request->ajax()){
            $actividades  = Actividades::all();
        return response()->json(['actividades'=> $actividades]);
       }
   }
   public function getHorarios(Request $request){
   
    $dia = $request->params['dia'];
    $idactividad = $request->params['idactividad'];
    
    $ho = DB::table('actividadeshorarios as ah')
                ->select('ah.id','ah.hini', 'ah.hfin') 
                ->where([['ah.active', '=', '1'], ['ah.actividades_id', '=', $idactividad], ['ah.'.$dia, '=','1']])
                ->get();
                foreach ($ho as $horario ) {
                     $horario->hini = Carbon::createFromTimeString($horario->hini)->format('g:i a');
                     $horario->hfin = Carbon::createFromTimeString($horario->hfin)->format('g:i a');
                }   
                return response()->json(['horarios' => $ho]);

   }
}
