<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ActividadesHorario;
use App\TipoActividades;
use Carbon\Carbon;

class ReservacionesController extends Controller
{
    public function index(){
        return view('sections.reservations');
    }

   public function dashboard(){

    $rangohoras = DB::table('actividadeshorarios')
    ->select(DB::raw('MAX(hfin) as ultima_hora , MIN(hini) as primer_hora'))
    ->first();

    $tipoActividades = DB::table('tipoactividades')
    ->select('nombre', 'color','id')
    ->get();

    $ultima_hora = Carbon::createFromFormat('H:i:s', $rangohoras->ultima_hora);
    $total_horas = $ultima_hora->diffInHours($rangohoras->primer_hora) + 1;


    $tipo_actividades_id = TipoActividades::all('id');
    $actividades = array();
    foreach ($tipo_actividades_id as $tipo_actividad_id) {
     
        $info_actividad = TipoActividades::find($tipo_actividad_id['id'])
        ->Actividades()
        ->select('id', 'clave')
        ->get();
    
        $actividades[] = $info_actividad;
    }

       return response()->json([
            'total_horas'=>$total_horas,
            'hini'=>$rangohoras->primer_hora,
            'hfin'=> $rangohoras->ultima_hora,
            'tipo_actividades' => $tipoActividades,
            'actividades'=>$actividades 
        ]);
   }
}
