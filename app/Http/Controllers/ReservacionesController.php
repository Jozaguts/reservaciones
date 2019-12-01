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
    // $actividades = actividades::with('TipoActividad','horarios')
    // ->get();
    // $tipoActividades = TipoActividades::all('id','clave','nombre','color');


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
    // '1111-11-11'

    $day =$request->params['day'];
    // $carbaoDay = $dt2 = Carbon::createFromDate($day);

    $carbaoDay = Carbon::createFromFormat('Y-m-d', $day);
    $lunes = $carbaoDay->startOfWeek()->format('Y-m-d');

        $week = array();
        for ($i=0; $i <7 ; $i++) {
            $week[] = $carbaoDay->startOfWeek()->addDay($i)->format('Y-m-d');
        }
        // dd($week);

        $horarios = array();
    foreach ($week as $day ) {
        $horario= DB::table('actividades as ac')
    ->join('actividadeshorarios as ah', 'ac.id', '=', 'ah.actividades_id')
    ->join('tipoactividades as ta', 'ta.id', '=', 'ac.tipoactividades_id')
    ->select(
        'ac.id as actividadid',
        DB::raw('concat(ac.clave, " | ", ac.nombre)  as name'),
        DB::raw('concat(ac.clave, " | ", ac.nombre)  as details'),
        DB::raw('concat("'.$day.'" , " ", SUBSTRING(ah.hini,1,5)) as start'),
        DB::raw('concat("'.$day.'") as end'),
        'ta.color'
    )
    ->where([['ac.active', '=', '1'], ['ah.active', '=', '1'], [DB::raw('ELT(WEEKDAY("'.$day.'") + 1, l, m, x, j, v, s, d)'), '=', '1']])
    ->get();

    $horarios[]=$horario;

    }
    // $horariosFlaten = array_flatten($horarios);

    // foreach($horariosFlaten as $horario){
    //     ($horario->details = $horario->details . "<br> dasasasasdasds <br> assasasasasas");
    // }





    // dd('stop');
    // $horario= DB::table('actividades as ac')
    // ->join('actividadeshorarios as ah', 'ac.id', '=', 'ah.actividades_id')
    // ->join('tipoactividades as ta', 'ta.id', '=', 'ac.tipoactividades_id')
    // ->select(
    //     'ac.id as actividadid',
    //     DB::raw('concat(ac.clave, " | ", ac.nombre)  as name'),
    //     DB::raw('concat(ac.clave, " | ", ac.nombre)  as details'),
    //     DB::raw('concat("'.$day.'" , " ", SUBSTRING(ah.hini,1,5)) as start'),
    //     DB::raw('concat("'.$day.'") as end'),
    //     'ta.color'
    // )
    // ->where([['ac.active', '=', '1'], ['ah.active', '=', '1'], [DB::raw('ELT(WEEKDAY("'.$day.'") + 1, l, m, x, j, v, s, d)'), '=', '1']])
    // ->get();


    return response()->json(['horario' =>array_flatten($horarios)]);


   }
}
