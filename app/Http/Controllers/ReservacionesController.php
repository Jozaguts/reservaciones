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
 
    $date = Carbon::now();
 
    $tipoActividades = DB::table('tipoactividades')
    ->select('nombre', 'color','id')
    ->get();
    $info = [];
   
    foreach ($tipoActividades as $tipoActividad) {
        $actividades = Actividades::all()
        ->where('tipoactividades_id', $tipoActividad->id);

        foreach($actividades as $actividad){

            $horarios = Actividades::find( $actividad->id)
            ->horarios()
            ->get();
          
           
            foreach($horarios as $horario){
                $l="";$m="";$x="";$j="";$v="";$s="";$d="";
                $horario->l == 1 ? $l="Lunes":$l=""; 
                $horario->m == 1 ? $m="Martes":$m=""; 
                $horario->x == 1 ? $x="Miércoles":$x=""; 
                $horario->j == 1 ? $j="Jueves":$j=""; 
                $horario->v == 1 ? $v="Viernes":$v=""; 
                $horario->s == 1 ? $s="Sábado":$s=""; 
                $horario->d == 1 ? $d="Domingo":$d=""; 


                // dd($l,$m , $horario->l);

                $infoActividad = [
                    'color'=> $tipoActividad->color,
                    'details' => "$l $m $x $j $v $s $d <br>
                     Hora Inicio: $horario->hini <br> Hora Fin $horario->hfin",
                    'end' => $date->addDay()->format('Y-m-d'),
                    'start' => $date->format('Y-m-d'),
                    'name'=> "$actividad->nombre ",
                    'horario_id' =>  $horario->id,
                    'actividad_id' => $actividad->id 
    
                    // 'tipo_actividad_id'=> $tipoActividad->id,
                    // 'tipo_actividad_nombre'=> $tipoActividad->nombre,
                    // 'actividad_id' => $actividad->id,
                    // 'actividad_clave'=> $actividad->clave,
                    // 'actividad_nombre'=>$actividad->nombre,
                    // 'actividad_horarios'=> $horarios  
                ];
                $info[]=$infoActividad;
            }
          

           

           
        }
       
      
    }

  
       return response()->json([
            'tipo_actividades' => $tipoActividades,
            'actividades'=>$info 
        ]);
   }
}
