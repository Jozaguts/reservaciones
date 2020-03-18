<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Actividades;
use App\Personas;
use Carbon\Carbon;

class ReservacionesController extends Controller
{
    public function index()
    {
        return view('sections.reservations');
    }

    public function dashboard(Request $request)
    {
        $carbonDay = Carbon::createFromFormat('Y-m-d', $request->day);
        $lunes = $carbonDay->startOfWeek()->format('Y-m-d');
        $week = array();
        for ($i = 0; $i < 7; ++$i) {
            $week[] = $carbonDay->startOfWeek()->addDay($i)->format('Y-m-d');
        }

        $horarios = array();
        $libre_icon = "<i class='libre_icon'></i>";
        $ocupacion_icon = "<i class='ocupacion_icon'></i>";
        $show_icon = "<i class='show_icon'></i>";
        $noshow_icon = "<i class='noshow_icon'></i>";
        foreach ($week as $day) {
            $horario = DB::table('actividades as ac')
                ->join('actividadeshorarios as ah', 'ac.id', '=', 'ah.actividades_id')
                ->join('tipoactividades as ta', 'ta.id', '=', 'ac.tipoactividades_id')
                ->leftJoin('asignaciones as asi', 'ah.id', '=', 'asi.actividad_horario_id')
                ->leftJoin('unidades as uni', 'asi.unidad_id', '=', 'uni.id')
                ->leftJoin('disponibilidad as dis', function ($join) {
                    $join->on('ah.id', '=', 'dis.horario_id');
                    $join->on('uni.id', '=', 'dis.unidad_id');
                })
                ->select(
                    'ac.id as actividadid',
                    DB::raw('concat(ac.clave, " | ", ac.nombre)  as name'),
                    DB::raw('concat("'.$ocupacion_icon.'",  SUM(IFNULL(dis.ocupacion,0)),
                        "'.$libre_icon.'",SUM(IFNULL(uni.capacidad,0)) -  SUM(IFNULL(dis.ocupacion,0)),
                        "'.$show_icon.'0","'.$noshow_icon.'0")  as details'),
                    DB::raw('concat("'.$day.'", " ", SUBSTRING(ah.hini,1,5)) as start'),
                    DB::raw('concat("'.$day.'") as end'),
                    'ta.color', 'ac.libre', 'ah.hfin'
                )
                ->where([['ac.active', '=', '1'], ['ah.active', '=', '1'], ['asi.salida', '=', '1'], [DB::raw('ELT(WEEKDAY("'.$day.'") + 1, l, m, x, j, v, s, d)'), '=', '1']])
                ->groupBy('ac.id', 'ac.clave', 'ac.nombre', 'ah.hini', 'ta.color', 'ah.hfin')
                ->get();
            if(count($horario) > 0){

                $fec = Carbon::createFromFormat('Y-m-d H:i', $horario[0]->start)->addHour(1)->format('Y-m-d H:i');
                $hini = Carbon::createFromFormat('Y-m-d H:i', $horario[0]->start)->format('H:i');
                $hfin = Carbon::createFromFormat('H:i:s', $horario[0]->hfin)->format('H:i');
                $dif = (int) $hfin - (int) $hini;
                for ($i = 0; $i < count($horario); ++$i) {
                    if ($horario[$i]->libre == 1) {
                        for ($j = 0; $j < $dif; ++$j) {
                            $arrLibre = [
                                'actividadid' => $horario[$i]->actividadid,
                                'name' => $horario[$i]->name,
                                'details' => $horario[$i]->details,
                                'start' => Carbon::createFromFormat('Y-m-d H:i', $horario[0]->start)->addHour($j)->format('Y-m-d H:i'),
                                'end' => $horario[$i]->end,
                                'color' => $horario[$i]->color,
                                'libre' => $horario[$i]->libre,
                            ];
                            $horarios[] = $arrLibre;
                        }
                    } else {
                        $arrLibre = [
                            'actividadid' => $horario[$i]->actividadid,
                            'name' => $horario[$i]->name,
                            'details' => $horario[$i]->details,
                            'start' => $horario[$i]->start,
                            'end' => $horario[$i]->end,
                            'color' => $horario[$i]->color,
                            'libre' => 2,
                        ];
                        $horarios[] = $arrLibre;
                    }
                }
            }
        }

        return response()->json(['horarios' => $horarios]);
        // return response()->json(['horarios' => array_flatten($horarios)]);
    }

    public function getActividades(Request $request)
    {
        if ($request->ajax()) {
            $actividades = Actividades::all();

            return response()->json(['actividades' => $actividades]);
        }
    }

    public function getHorarios(Request $request)
    {
        $dia = $request->dia;
        $idactividad = $request->idactividad;

        $ho = DB::table('actividadeshorarios as ah')
            ->join('actividades as ac', function ($join) {
                $join->on('ah.actividades_id', '=', 'ac.id');
                $join->on('ah.libre', '=', 'ac.libre');
            })
            ->select('ah.id', 'ah.hini', 'ah.hfin', 'ah.libre', 'ac.duracion')
            ->where([['ah.active', '=', '1'], ['ah.actividades_id', '=', $idactividad], ['ah.'.$dia, '=', '1']])
            ->get();
        $horarios = [];
        $horarioLibres = [];
        foreach ($ho as $horario) {
            if ($horario->libre) {
                $duracion = ($horario->duracion) / 60;

                $hini = new Carbon("2014-03-30 $horario->hini", 'Europe/London');
                $hfin = new Carbon("2014-03-30 $horario->hfin", 'Europe/London');
                $diff = $hini->diffInHours($hfin);
                for ($i = 0; $i <= $diff; ++$i) {
                    $horarios['id'] = $horario->id;
                    $horarios['hini'] = Carbon::createFromTimeString($horario->hini)->addHour($i)->format('g:i a');
                    $horarios['hfin'] = Carbon::createFromTimeString($horario->hini)->addHour($i + $duracion)->format('g:i a');
                    $horarios['libre'] = $horario->libre;

                    array_push($horarioLibres, $horarios);
                }

                return response()->json(['horarios' => $horarioLibres]);
            } else {
                $horario->hini = Carbon::createFromTimeString($horario->hini)->format('g:i a');
                $horario->hfin = Carbon::createFromTimeString($horario->hfin)->format('g:i a');
            }
        }

        return response()->json(['horarios' => $ho]);
    }

    public function getSalidas($horarioId)
    {
        $sa = DB::table('salida_llegadahorarios as sh')
            ->join('salidallegadas as sal', 'sh.salidallegadas_id', '=', 'sal.id')
            ->select('sh.id', 'sal.id as salid', DB::raw('CONCAT(IFNULL(sh.hora, ""), IF(LENGTH(sh.hora)>0, " | ", ""), sal.nombre) as salida'))
            ->where([['sal.active', '=', '1'], ['sh.actividadeshorario_id', '=',  $horarioId], ['sh.salida', '=', '1']])
            ->get();

        return $sa;
    }

    public function getLlegadas($horarioId)
    {
        $ll = DB::table('salida_llegadahorarios as sh')
            ->join('salidallegadas as sal', 'sh.salidallegadas_id', '=', 'sal.id')
            ->select('sh.id', 'sal.id as salid', DB::raw('CONCAT(IFNULL(sh.hora, ""), IF(LENGTH(sh.hora)>0, " | ", ""), sal.nombre) as llegada'))
            ->where([['sal.active', '=', '1'], ['sh.actividadeshorario_id', '=', $horarioId], ['sh.salida', '=', '0']])
            ->get();

        return $ll;
    }

    public function getSalidasLlegadas(Request $request)
    {
        $salidas = $this->getSalidas($request->horarioId);
        $llegadas = $this->getLlegadas($request->horarioId);
        $ocupacion = $this->getOcupacion($request->horarioId);

        return response(['llegadas' => $llegadas, 'salidas' => $salidas, 'ocupacion' => $ocupacion]);
    }

    public function getOcupacion($horarioId)
    {
        $od = DB::table('actividadeshorarios as ah')
            ->leftJoin('asignaciones as asi', 'ah.id', '=', 'asi.actividad_horario_id')
            ->leftJoin('unidades as uni', 'asi.unidad_id', '=', 'uni.id')
            ->leftJoin('disponibilidad as dis', function ($join) {
                $join->on('ah.id', '=', 'dis.horario_id');
                $join->on('uni.id', '=', 'dis.unidad_id');
            })
            ->select('ah.id', DB::raw('IFNULL(sum(dis.ocupacion),0) as ocupacion, IFNULL(sum(uni.capacidad),0) as disponibilidad'))
            ->where([['ah.id', '=', $horarioId], ['asi.salida', '=', '1']])
            ->groupBy('ah.id')
            ->first();

        return $od;
    }

    public function getPersonas(Request $request)
    {
        if ($request->ajax()) {
            $personas = Personas::all();

            return response(['personas' => $personas]);
        } else {
            return response(['response' => 'petición no valida']);
        }
    }

    public function fillOcupacionSelect(Request $request)
    {
        $bap = DB::table('actividades as ac')
            ->join('actividadprecios as acp', 'ac.id', '=', 'acp.actividad_id')
            ->select('acp.id', DB::raw('IF(ac.balance, "Sencillo", "") as Sencillo'), DB::raw('IF(acp.doblebalanc, "Doble", "") as doble'), DB::raw('IF(acp.triplebalanc, "Triple", "") as triple'))
            ->where([['ac.id', '=', $request->actividadId], ['acp.persona_id', '=', $request->personaId]])
            ->first();
        unset($bap->id);
        if (empty($bap->Sencillo)) {
            unset($bap->Sencillo);
        } elseif (empty($bap->doble)) {
            unset($bap->doble);
        } elseif (empty($bap->triple)) {
            unset($bap->triple);
        }

        return response(['ocupacion' => $bap]);
    }

    public function getBalancePrecio(Request $request)
    {
        $porcentajeAnticipo = $this->getActicipoMninio($request->actividadId);
        
        $act= $request->actividadId;
        $per=$request->personaId;
        $com=$request->comisionistaId;
        $ocu= $request->ocupacion;

        $ba = DB::table('actividades as ac')
            ->join('actividadprecios as acp', 'ac.id', '=', 'acp.actividad_id')
            ->join('comisionistadet as cod', 'ac.id', '=', 'cod.idactividad')
            ->join('comisionistas as com', 'cod.idcomisionista', '=', 'com.id')
            ->select('acp.id'
                , DB::raw('CASE WHEN com.facturable=0 THEN CASE WHEN "' . $ocu . '"="Sencillo" THEN ac.balance WHEN "' . $ocu . '"="Doble" THEN acp.doblebalanc WHEN "' . $ocu . '"="Triple" THEN acp.triplebalanc End ELSE CASE WHEN "' . $ocu . '"="Sencillo" THEN CASE WHEN cod.precio="2" THEN CASE WHEN acp.precio2=0 THEN ac.balance else acp.precio2 END ELSE CASE WHEN acp.precio3=0 THEN ac.balance ELSE acp.precio3 end END WHEN "' . $ocu . '"="Doble" THEN acp.doblebalanc WHEN "' . $ocu . '"="Triple" THEN acp.triplebalanc End  END as balance')
                , DB::raw('CASE WHEN "' . $ocu . '"="Sencillo" THEN CASE WHEN acp.precio1>0 THEN acp.precio1 ELSE ac.precio END WHEN "' . $ocu . '"="Doble" THEN CASE WHEN acp.doble>0 THEN acp.doble ELSE ac.precio END WHEN "' . $ocu . '"="Triple" THEN CASE WHEN acp.triple>0 THEN acp.triple ELSE ac.precio END End as precio')
                , DB::raw('CASE WHEN com.facturable=1 THEN CASE WHEN cod.precio="2" THEN CASE WHEN acp.precio2=0 THEN "No se encontro balance facturable" ELSE "" END ELSE CASE WHEN acp.precio3=0 THEN "No se encontro precio facturable" ELSE "" END  END ELSE "" END as balance_fac'))
            ->where([['ac.id', '=', $act], ['acp.persona_id', '=', $per], ['com.id', '=', $com]])
            ->first();
        

        return response(['balance' => $ba->balance, 'precio' => $ba->precio, 'porcentajeAnticipo'=> $porcentajeAnticipo->porcentaje]);
    }


    public function getActicipoMninio($actividadId)
    {
        return  $anticipo = DB::table('anticipos')
       ->join('actividades', 'actividades.anticipo_id', '=', 'anticipos.id')
       ->select('anticipos.porcentaje')
       ->where('actividades.id','=', $actividadId)
       ->first();
    }
}
