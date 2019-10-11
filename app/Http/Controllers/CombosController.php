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
               ->where([['ac.active', '=','1'], ['ac.remove','=','0'], ['ac.renta','=','0']])
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
        
           
        }, 2);

        return response()->json([
            'success' => 'Combo Guardado Con exito'
        ]);
     
    
   









        // $validator = Validator::make($request->all(), [
      
        //     'idusuario' => 'required|unique:actividades',
        //     'clave' => 'required',
        //     'nombre' => 'required',
        //     'tipoactividades_id' => 'required',
        //     'maxcortesias' => 'required',
        //     'maxcupones' => 'required',
        //     'anticipo_id' => 'required',
        //     'mismodia' => 'required',
        //     'active' => 'required',
        //     'remove' => 'required',
        //     'combo' => 'required',
        //     'select_actividad_id_5' => 'required'
        // ]);
        // $errors = $validator->errors();

        // // $validated = $request->validated();
        // // $combo = Actividades::create(['name' => 'Flight 10']);
        // // $request->validated();
        // dd($errors, $request);
        

           //reglas de validacion
        //    $rules =[
        //     'clave' => ['required', 'string', 'min:5','unique:actividades'],
        //     'nombre' => ['required', 'string', 'max:255'],
        //     'tipoactividades_id'=> ['required', 'integer'],
        //     'active'=> ['nullable', 'boolean'],
        //     'remove' => ['nullable','boolean'],
        //     'maxcortesias'=>['nullable','integer'],
        //     'maxcupones'=>['nullable','integer'],
        //     'anticipo_id'=>['required','integer'],
        //     'idusuario'=> ['integer','required'],
        //     'libre'=> ['boolean','nullable'],
        //     'combo'=> ['boolean','nullable']
        // ];
       
            //  //Se realiza la validación
            //  $validator = Validator::make($request->all(), $rules);
            //  if($validator->fails()){
            //     return response()->json(['errors'=> $validator->errors()->all()]);
            //  }else{
            //      $act = Actividades::create([
            //         'clave' => $request['clave'],
            //         'nombre' => $request['nombre'],
            //         'tipoactividades_id' =>$request['tipoactividades_id'],
            //         'active'=> '1',
            //         'remove' => '0',
            //         'maxcortesias'=>$request['maxcortesias'],
            //         'maxcupones'=>$request['maxcupones'],
            //         'anticipo_id'=>$request['anticipo_id'],
            //         'idusuario'=> $request['idusuario'],
            //         'libre'=> $request['libre'],
            //         'combo'=> '1',
            //         'precio' => $request->get('precio'),
            //         'balance' => $request->get('balance'),
            //         'fijo'=>0,
            //         'renta'=>0,
            //         'promocion' => 0,
            //         'riesgo'=>0,
            //         'tipounidades_id'=>1                     
            //          ]);
                
            //          if($act){
            //              for ($h=0; $h < count($request->get('dataSet')); $h++) { 
            //                 $cDet = ComboDet::create([
            //                     'hini' => $request->get('dataSet')[$h]['hini'],
            //                     'hfin' =>$request->get('dataSet')[$h]['hfin'],
            //                     'actividades_id'=>$request->get('dataSet')[$h]['actividades_id'],
            //                     'horario_id' =>$request->get('dataSet')[$h]['horario_id'],
            //                     'usuarios_id'=>$request['idusuario'],
            //                     'actividades_id_combo'=>$act->id,
            //                     'active'=>'1',
            //                     'remove'=>'0'
            //                 ]);
            //              }
                 
                      
                        
            //                     // inserta precios
            //     $datosPersonas = $request->datosPersonas;
            //     foreach ($datosPersonas as $datoPersona ) {
            //         if($datoPersona['acompanante'] == 'null') {                  
            //             $datoPersona['acompanante'] = 0;
            //         }
            //         if($datoPersona['restriccion'] == 'null') {                  
            //             $datoPersona['restriccion'] = 0;
            //         }
            //         if($datoPersona['promocion'] == 'null') {                  
            //             $datoPersona['promocion'] = 0;
            //         }                 
            //         $actividadPrecio = ActividadPrecios::firstOrCreate(
            //             ['actividades_id' => $act->id, 'persona_id' => $datoPersona['persona_id']  ], 
            //             [
            //             'precio1' => $datoPersona['precio1'],
            //             'precio2'=> $datoPersona['precio2'],
            //             'precio3'=> $datoPersona['precio3'],
            //             'doble'=> $datoPersona['doble'],
            //             'doblebalanc'=> $datoPersona['doblebalanc'],
            //             'triple'=> $datoPersona['triple'],
            //             'triplebalanc'=> $datoPersona['triplebalanc'],
            //             'promocion'=> $datoPersona['promocion'],
            //             'restriccion'=> $datoPersona['restriccion'],
            //             'active'=> $datoPersona['active'],
            //             'acompanante'=> $datoPersona['acompanante'],
            //             'remove'=> $datoPersona['remove'],
            //             'usuarios_id'=> $request->get('idusuario'),
            //             ]
            //         );
            //         $actividadPrecio->save();
            //     }  



            //             return response()->json(['message' => 'Combo Guardado']);
            //          }else{
            //             return response()->json(['message'=>'Error Al Guardar']);
            //          }
            //  }
           
            
             
        

        
     
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
        $combo = DB::table('actividades as ac')
       ->select('ac.id', 'ac.clave', 'ac.nombre','ac.precio','ac.balance', 'ac.duracion', 'ac.anticipo_id', 'ac.tipoactividades_id', 'ac.maxcortesias', 'ac.maxcupones','ac.mismo_dia')
       ->where([['ac.active', '=','1'], ['ac.remove','=','0'], ['ac.renta','=','0'],['ac.combo','=','1'], ['ac.id', '=', $id]])
       ->orderBy('ac.clave')
       ->get();
     
       $actp = DB::table('actividadprecios as ap')
      ->join('personas as pe', 'ap.persona_id', '=', 'pe.id')
      ->select('ap.id', 'pe.id as peid', 'pe.nombre as penombre', 'ap.precio1', 'ap.precio2', 'ap.precio3', 'ap.doble', 'ap.doblebalanc', 'ap.triple', 'ap.triplebalanc', 'ap.promocion', 'ap.restriccion', 'ap.acompanante')
      ->where([['ap.actividades_id', '=', $id],  ['ap.remove', '=', '0']])
      ->orderBy('ap.id')
      ->get();

      
 
       $ach = DB::table('combo_det as co')
            ->join('actividades as ac', 'co.actividades_id', '=', 'ac.id')
            ->join('actividadeshorarios as ach', 'co.horario_id', '=', 'ach.id')
            ->select('co.id', 'ac.id as acid', 'ac.clave', 'ac.nombre','ac.precio','ac.balance', 'ac.duracion', DB::raw('concat ( substring(IF(ach.libre=1, co.hini, ach.hini),1,5), " | ", substring(IF(ach.libre=1, co.hfin, ach.hfin),1,5), " | ", IF(ach.l=1, "L", ""), IF(ach.l=m, " M", ""), IF(ach.x=1, " X", ""), IF(ach.j=1, " J", ""), IF(ach.v=1, " V", ""), IF(ach.s=1, " S", ""), IF(ach.d=1, " D", "")) as horario'), 'co.horario_id', 'ach.libre', 'ach.hini', 'ach.hfin')
            ->where([['co.active', '=', '1'], ['co.remove', '=', '0'], ['co.actividades_id_combo', '=', $id]])
           ->get();
         
           
         $horarios = array();
        
        for ($i=0; $i < $ach->count(); $i++) { 
                array_push($horarios, $ach[$i]);
        }
            return response()->json(['infoCombo' => $combo, 'horarios'=> $horarios,'activiadadPrecios'=>$actp]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function infoactividad(Request $request, $id){

        /* Obtento la informacion de la activiad */

        $infoActividad = [];

        $actividad = Actividades::find($id)
        ->where('active', '1')
        ->where('remove','0')
        ->where('renta','0')
        ->where('combo','0')
        ->where('id', $id)
        ->get();

        /* Obtengo los horarios de la actividad */
        $actividadesHorarios = DB::table('actividadeshorarios')
        ->where('active','1')
        ->where('remove','0')
        ->where('actividades_id',$id)
        ->get();
        // dd( $actividadesHorarios);
        /* Se generan las options para el select de la actividad */
        $options = [];
       
        foreach ($actividadesHorarios as $actividadesHorario ) {
        /* Si el horario es LIBRE se generan multiples opciones que van desde la hora de 
        ** Inicio  HINI hasta la hora
        ** final HFIN
        ** con intervalos de una hora 
        */
        if($actividadesHorario->libre == 1){
        $hini = Carbon::createFromFormat('H:m:s', $actividadesHorario->hini)->format('H');   
        $hfin = Carbon::createFromFormat('H:m:s', $actividadesHorario->hfin)->format('H');

        $lenght = (int)$hfin - (int)$hini; /* Vueltas === cantidad de opciones en el select */

        for ($i=0; $i < $lenght ; $i++) { 

        $selecthini= Carbon::create(2012, 1, 31, $hini)->addHour($i)->format('H:m');
        $selecthfin= Carbon::create(2012, 1, 31, $hini)->addHour($i+1)->format('H:m');

        $l = $actividadesHorario->l ==1 ? "L": ""; 
        $m = $actividadesHorario->m ==1 ? "M": ""; 
        $x = $actividadesHorario->x ==1 ? "X": ""; 
        $j = $actividadesHorario->j ==1 ? "J": ""; 
        $v = $actividadesHorario->v ==1 ? "V": ""; 
        $s = $actividadesHorario->s ==1 ? "S": ""; 
        $d = $actividadesHorario->d ==1 ? "D": "";
        
        $options[] = "<option> $selecthini | $selecthfin | $l $m $x $j $v $s $d </option>"; 

        } 
      
        $infoActividad[] =$actividad;
        $infoActividad[] =$options;
     
        return  $infoActividad;
        // acomodar la hoar final en hoario libre 
        }else if($actividadesHorario->libre ==0){
   
        $hini = Carbon::createFromFormat('H:m:s', $actividadesHorario->hini)->format('H:m');   
        $hfin = Carbon::createFromFormat('H:m:s', $actividadesHorario->hfin)->format('H:m'); 
        $l = $actividadesHorario->l ==1 ? "L": ""; 
        $m = $actividadesHorario->m ==1 ? "M": ""; 
        $x = $actividadesHorario->x ==1 ? "X": ""; 
        $j = $actividadesHorario->j ==1 ? "J": ""; 
        $v = $actividadesHorario->v ==1 ? "V": ""; 
        $s = $actividadesHorario->s ==1 ? "S": ""; 
        $d = $actividadesHorario->d ==1 ? "D": "";

        $options[] = "<option> $hini | $hfin | $l $m $x $j $v $s $d </option>"; 

        }
        
        $infoActividad[] =$actividad;
        $infoActividad[] =$options;
     
        return  $infoActividad;
        }
        
        
        
    }


   
  
}
