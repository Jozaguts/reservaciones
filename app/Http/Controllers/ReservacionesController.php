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
    $actividades = actividades::with('TipoActividad','horarios')
    ->get();
    $tipoActividades = TipoActividades::all('id','clave','nombre','color');


    // $hinimin = DB::table('actividadeshorarios')->min('hini');
    // $hfinmax = DB::table('actividadeshorarios')->min('hfin');


    // $tipoAInfoActInfoHor =array ();

    // foreach($actividades as $actividad) {


    //     $infoHorarios = array();

    //     foreach ($actividad->horarios as $horario) {
    //         $infoHorario =[
    //             'hini' => $horario->hini,
    //             'hfin' => $horario->hfin,
    //             'id' => $horario->id
    //         ];
    //         $infoHorarios[] = $infoHorario;


    //     }


    //     $info=[
    //         'tipo_actividad_id' => $actividad->TipoActividad->id,
    //         'tipo_actividad_clave'  => $actividad->TipoActividad->clave,
    //         'tipo_actividad_nombre'  => $actividad->TipoActividad->nombre,
    //         'tipo_actividad_color'  => $actividad->TipoActividad->color,
    //         'actividad_id'  => $actividad->id,
    //         'actividad_clave'  => $actividad->clave,
    //         'actividad_nombre'  => $actividad->nombre,
    //         'horarios' => $infoHorarios
    //     ];

    //     $tipoAInfoActInfoHor[]=$info;

    // }
    // $tipoAInfoActInfoHor['ininmin']= substr($hinimin,0,-3);
    // $tipoAInfoActInfoHor['hfinmax']=substr($hfinmax,0,-3);


    // return response()->json(['info'=>$tipoAInfoActInfoHor,'tipo_actividades' => $tipoActividades]);
    $horario= DB::table('actividades as ac')
    ->join('actividadeshorarios as ah', 'ac.id', '=', 'ah.actividades_id')
    ->join('tipoactividades as ta', 'ta.id', '=', 'ac.tipoactividades_id')
    ->select(
        'ac.id as actividadid',
        'ac.nombre as name',
        DB::raw('concat(ac.clave, " | ", ac.nombre)  as details'),
        DB::raw('concat(curdate(), " ", SUBSTRING(ah.hini,1,5)) as start'),
        DB::raw('concat(curdate()) as end'),
        'ta.color',
        DB::raw('curdate()')
    )
    ->where([['ac.active', '=', '1'], ['ah.active', '=', '1'], [DB::raw('ELT(WEEKDAY(curdate()) + 1, l, m, x, j, v, s, d)'), '=', '1']])
    ->get();

    return response()->json(['horario' =>$horario,/* 'tipo_actividades'=>$tipo_actividades */]);


   }
}
