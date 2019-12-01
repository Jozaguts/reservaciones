<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anticipos;
use App\TipoActividades;
use Validator;
use App\Actividades;
use App\ActividadesHorario;
use App\Personas;
use App\ComboDet;
use App\ActividadPrecios;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\CreateCombosRequest;
use App\Http\Requests\UpdateComboRequest;
use Illuminate\Support\MessageBag;


class CombosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $personas = Personas::all();
        $anticipos = Anticipos::all();
        $tipoactividades = TipoActividades::all();
         $actividades = DB::table('actividades as ac')
               ->select('ac.id', 'ac.clave', 'ac.nombre','ac.tipoactividades_id','ac.active', 'ac.combo','ac.precio', 'ac.balance')
               ->where([ ['ac.remove','=','0'], ['ac.renta','=','0'], ['ac.deleted_at','=',NULL]])
               ->orderBy('ac.clave')
               ->get();

        return view('sections.activities.combos',compact('anticipos','tipoactividades','actividades','personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCombosRequest $request)
    {
        DB::transaction(function() use ($request) {
            // esta consulta es para obtener el ID tipoUnidad
            $tipoactividades = DB::table('tipoactividades')->where('id', $request->tipoactividades_id)->first();
             DB::table('actividades')->insert([

                'clave' =>  $request->clave,
                'nombre' =>  $request->nombre,
                'maxcortesias' =>  $request->maxcortesias,
                'maxcupones' =>  $request->maxcupones,
                'mismo_dia' =>  $request->mismo_dia==null? 0:1,
                'precio' => $request->precio,
                'balance' => $request->balance,
                'anticipo_id' =>  $request->anticipo_id,
                'tipoactividades_id' =>  $request->tipoactividades_id,
                'tipounidades_id'=>  $tipoactividades->tipounidad_id,
                'idusuario' =>  $request->idusuario,
                'remove' =>  '0',
                'active' =>  '1',
                'combo' => '1',
                'fijo' => '0',
                'renta' => '0',
                'promocion' => '0',
                'riesgo' => '0',

            ]);

            $actividadId = DB::getPdo()->lastInsertId();

            for($i = 0; $i<count($request->precios); $i++){

                $precios = DB::table('actividadprecios')->insert([
                     'precio1' => $request->precios[$i]['precio1'],
                     'precio2' => $request->precios[$i]['precio2'],
                     'precio3' => $request->precios[$i]['precio3'],
                     'doble' => $request->precios[$i]['doble'],
                     'doblebalanc' => $request->precios[$i]['doblebalanc'],
                     'triple' => $request->precios[$i]['triple'],
                     'triplebalanc' => $request->precios[$i]['triplebalanc'],
                     'restriccion' => $request->precios[$i]['restriccion'],
                     'acompanante' => $request->precios[$i]['acompanante'],
                     'promocion' => $request->precios[$i]['promocion'],
                     'persona_id' => $request->precios[$i]['persona_id'],
                     'usuario_id' => $request->idusuario,
                     'actividad_id' => $actividadId,
                     'active' => '1',
                     'remove' => '0',
                ]);

            }

            for ($i=0; $i < count($request->actividades_combo); $i++) {

                $combo_det = DB::table('combo_det')->insert([
                    'hini' => substr($request->actividades_combo[$i]['select'], -0,5).':00',
                    'hfin'=> substr($request->actividades_combo[$i]['select'], 8, 5).':00',
                    'actividades_id_combo'=> $actividadId, //el ID actividad que acaba de ser creada (el combo)
                    'actividades_id' =>$request->actividades_combo[$i]['actividades_id'], // el ID  de la actividad que compone al combo
                    'horario_id' => $request->actividades_combo[$i]['horario_id'],
                    'usuarios_id'=> $request->idusuario,
                    'active' => '1',
                    'remove'=> '0'
                ]);

            }

        }, 2);

        return response()->json([
            'success' => 'Combo Guardado Con exito'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info=[];
        $infoHorarios = [];
        $ifoPrecios=[];


        $combo =  Actividades::find($id);

        $actividades = DB::table('combo_det')
        ->where('actividades_id_combo',$id)
        ->where('deleted_at',null)
        ->get();



        foreach($actividades as $actividad){

            $infoHorarios[] = $this->infoactividad($actividad->actividades_id,$actividad->id);


       }

        $info['combo']=$combo;
        $info['actividades']= $infoHorarios;
        $info['precios']= $combo->precios;

    return $info;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComboRequest $request, $id)
    {

        DB::transaction(function() use ($request, $id) {

             // esta consulta es para obtener el ID tipoUnidad
           $tipoactividades = DB::table('tipoactividades')->where('id', $request->tipoactividades_id)->first();
           Actividades::updateOrCreate(
               ['id'=>$id],
               [
                'nombre' =>  $request->nombre,
                'maxcortesias' =>  $request->maxcortesias,
                'maxcupones' =>  $request->maxcupones,
                'mismo_dia' =>  $request->mismo_dia==null? 0:1,
                'precio' => $request->precio,
                'balance' => $request->balance,
                'anticipo_id' =>  $request->anticipo_id,
                'tipoactividades_id' =>  $request->tipoactividades_id,
                'tipounidades_id'=>  $tipoactividades->tipounidad_id,
                'idusuario' =>  $request->idusuario,
                'remove' =>  '0',
                'active' =>  '1',
                'combo' => '1',
                'fijo' => '0',
                'renta' => '0',
                'promocion' => '0',
                'riesgo' => '0',
               ]
           );

           for($i = 0; $i<count($request->precios); $i++){
      
            ActividadPrecios::updateOrCreate(
                ['persona_id' => $request->precios[$i]['persona_id'],
                'actividad_id' => $id
                ],
                [
                    'precio1' => $request->precios[$i]['precio1'],
                    'precio2' => $request->precios[$i]['precio2'],
                    'precio3' => $request->precios[$i]['precio3'],
                    'doble' => $request->precios[$i]['doble'],
                    'doblebalanc' => $request->precios[$i]['doblebalanc'],
                    'triple' => $request->precios[$i]['triple'],
                    'triplebalanc' => $request->precios[$i]['triplebalanc'],
                    'restriccion' => $request->precios[$i]['restriccion'],
                    'acompanante' => $request->precios[$i]['acompanante'],
                    'promocion' => $request->precios[$i]['promocion'],
                    'persona_id' => $request->precios[$i]['persona_id'],
                    'usuario_id' => $request->idusuario,
                    'actividad_id' => $id,
                    'active' => '1',
                    'remove' => '0',
                ]
            );

           }

           for ($i=0; $i < count($request->actividades_combo); $i++) {
            ComboDet::updateOrCreate(
                [
                'actividades_id' => $request->actividades_combo[$i]['actividades_id'],
                'horario_id' => $request->actividades_combo[$i]['horario_id']
                ],
                [
                'hini' => substr($request->actividades_combo[$i]['select'], -0,5).':00',
                'hfin'=> substr($request->actividades_combo[$i]['select'], 8, 5).':00',
                'actividades_id_combo'=> $id, //el ID actividad (combo)
                'usuarios_id'=> $request->idusuario,
                'active' => '1',
                'remove'=> '0'
                ]
            );


        }




        });
        return response()->json([
            'success' => 'Combo Actualizado Con exito'
            ]);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $actividad = ComboDet::where('actividades_id_combo', $id)
        ->where('actividades_id',$request->activityId);

        if($actividad->delete()) {
            return response()->json([
                'success' => 'Actividad Eliminada Con exito'
                ]);
        }else{
            return response()->json([
                'success' => 'No se pudo eliminar la actividad por favor intenelo nuevamente'
                ]);
        }


    }

    public function desactivarcombo($id){


      $combo = Actividades::find($id);

     if( $combo->active == 1 ){
        $combo = DB::update('update actividades set active = 0 where id = ?', [$id]);
        return response()->json([
            'success' => 'Combo Desactivado Correctamente'
            ]);
     }else{
        $combo = DB::update('update actividades set active = 1 where id = ?', [$id]);
        return response()->json([
            'success' => 'Combo Activado Correctamente'
            ]);
     }


    }
    public function infoactividad($id,$id_combo_det=null ){

        /* Obtento la informacion de la activiad */

        $infoActividad = [];

        $actividad = Actividades::find($id)
        // ->where('active', '1')
        ->where('remove','0')
        ->where('renta','0')
        ->where('combo','0')
        ->where('id', $id)
        ->get();

        // /* Se generan las options para el select de la actividad */
        if($actividad[0]->libre == 1){
            $actividadesHorarios= Actividades::find($id)
            ->horarios
            ->where('libre', '1');

        }else {
            $actividadesHorarios= Actividades::find($id)
            ->horarios
            ->where('libre', '0');

        }




        $options = [];

        // foreach ($actividadesHorarios as $actividadesHorario ) {
        /* Si el horario es LIBRE se generan multiples opciones que van desde la hora de
        ** Inicio  HINI hasta la hora
        ** final HFIN
        ** con intervalos de una hora
        */
        if($actividad[0]->libre == 1){
         foreach ($actividadesHorarios as $actividadesHorario ) {
            $hini = Carbon::createFromFormat('H:m:s', $actividadesHorario->hini)->format('H');
            $hfin = Carbon::createFromFormat('H:m:s', $actividadesHorario->hfin)->format('H');

            $lenght = (int)$hfin - (int)$hini; /* Vueltas === cantidad de opciones en el select */

        for ($i=0; $i < $lenght ; $i++) {

            $selecthini= Carbon::create(2012, 1, 31, $hini)->addHour($i)->format('h:s');
            $selecthfin= Carbon::create(2012, 1, 31, $hini)->addHour($i+1)->format('h:s');

            $l = $actividadesHorario->l ==1 ? "L": "";
            $m = $actividadesHorario->m ==1 ? "M": "";
            $x = $actividadesHorario->x ==1 ? "X": "";
            $j = $actividadesHorario->j ==1 ? "J": "";
            $v = $actividadesHorario->v ==1 ? "V": "";
            $s = $actividadesHorario->s ==1 ? "S": "";
            $d = $actividadesHorario->d ==1 ? "D": "";
            $horario='';
            if($id_combo_det!=null){
                $combo_det = ComboDet::where('horario_id', $actividadesHorario->id)
                ->where('id',$id_combo_det)
                ->first();
                $hiniOpt = $combo_det['hini'];
                $hfinOpt = $combo_det['hfin'];
                $horario = " $hiniOpt | $hfinOpt ";

            }


            $options[] = "<option name='horario_id' value='$actividadesHorario->id' data-horariotext='$horario'> $selecthini | $selecthfin | $l $m $x $j $v $s $d </option>";

        }

        $infoActividad[] =$actividad;
        $infoActividad[] =$options;

        return  $infoActividad;
        }
        // acomodar la hoar final en hoario libre
        }


        else if($actividad[0]->libre == 0){

            foreach ($actividadesHorarios as $actividadesHorario ) {

                $hini = Carbon::createFromFormat('H:m:s', $actividadesHorario->hini)->format('H:m');

                $hfin = Carbon::createFromFormat('H:m:s', $actividadesHorario->hfin)->format('H:m');
                // $hini = Carbon::parse($actividadesHorario->hini);
                // dd($hini);
                $l = $actividadesHorario->l ==1 ? "L": "";
                $m = $actividadesHorario->m ==1 ? "M": "";
                $x = $actividadesHorario->x ==1 ? "X": "";
                $j = $actividadesHorario->j ==1 ? "J": "";
                $v = $actividadesHorario->v ==1 ? "V": "";
                $s = $actividadesHorario->s ==1 ? "S": "";
                $d = $actividadesHorario->d ==1 ? "D": "";

                $horario='';
                if($id_combo_det!=null){
                    $combo_det = ComboDet::where('horario_id', $actividadesHorario->id)
                    ->where('id',$id_combo_det)
                    ->first();

                    $hiniOpt = Carbon::createFromFormat('H:m:s',  $combo_det['hini'])->format('H:m');
                    $hfinOpt = Carbon::createFromFormat('H:m:s',  $combo_det['hfin'])->format('H:m');

                    $horario = " $hiniOpt | $hfinOpt ";

                }

                $options[] = "<option name='horario_id' value='$actividadesHorario->id' data-horariotext='$horario'> $hini | $hfin | $l $m $x $j $v $s $d </option>";
            }
        }

        $infoActividad[] =$actividad;
        $infoActividad[] =$options;


        return  $infoActividad;
        // }



    }





}
