<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\TipoActividades;
use Illuminate\Http\Request;
use App\TipoUnidad;
use App\Anticipos;
use App\Personas;
use App\SalidasLlegadas;
use Validator;
use App\ActividadPrecios;
use App\ActividadesHorario;
use App\SalidasLlegadasHorario;
use Illuminate\Support\Facades\DB;

class ActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $personas = Personas::all();
        $salidasLlegadas = SalidasLlegadas::all();
        $anticipos = Anticipos::all();
        $actividades = Actividades::all();
        $tipoactividades = TipoActividades::all();
        return view('sections.activities.activities', compact('actividades','tipoactividades','tipounidades','anticipos','personas','salidasLlegadas'));
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
    public function store(Request $request)
    {
            //reglas de validacion
             $rules =[
                'clave' => ['required', 'string', 'min:5','unique:actividades'],
                'nombre' => ['required', 'string', 'max:255'],
                'tipoactividades_id'=> ['required', 'integer'],
                'fijo'=> ['nullable', 'boolean'],
                'renta' => ['nullable','boolean'],
                'active'=> ['nullable', 'boolean'],
                'remove' => ['nullable','boolean'],
                'duracion' => ['nullable','integer'],
                'minutoincrementa'=>['nullable','integer'],
                'montoincremento'=>['nullable','between:0,999999.99'],
                'maxcortesias'=>['nullable','integer'],
                'maxcupones'=>['nullable','integer'],
                'anticipo_id'=>['required','integer'],
                'idusuario'=> ['integer','required'],
                'tipounidades_id'=>['integer', 'required'],
                'precio' =>['required','between:0,999999.99'],
                'balance' =>['required','between:0,999999.99'],
                'promocion'=>['boolean','nullable'],
                'combo' =>['boolean','nullable'],
                'observaciones' =>['nullable','string'], 
                'requisitos' =>['nullable','string'],
                'riesgo' =>['nullable','boolean'],
                'puntos' =>['nullable','integer'],
                'libre'=> ['boolean'],
                'salidas'=>['integer', 'nullable'],
                'llegadas'=>['integer','nullable']                
            ];
       

         if($request->ajax())
         {
              //Se realiza la validación
              $validator = Validator::make($request->all(), $rules);
              // $result = TipoActividades::create($request->all());
              if ($validator->fails()) 
              {
                $tipoActividadId = $request->get('tipoactividades_id');
                $tipoActividad = TipoActividades::find($tipoActividadId);

                return response()->json(['error'=> 'true','errors'=>$validator->errors()->all()]); 
              }else{
                $tipoActividadId = $request->get('tipoactividades_id');
                $tipoActividad = TipoActividades::find($tipoActividadId);

                // inserta actividad
                $actividad = Actividades::create([
                    'clave' => $request->get('clave'),
                    'nombre' => $request->get('nombre'),
                    'tipoactividades_id'=> $request->get('tipoactividades_id'),
                    'fijo'=> $request->get('fijo'),
                    'renta' => $request->get('renta'),
                    'active'=> $request->get('active'),
                    'remove' => $request->get('remove'),
                    'duracion' => $request->get('duracion'),
                    'minutoincrementa'=>$request->get('minutoincrementa'),
                    'montoincremento'=>$request->get('montoincremento'),
                    'maxcortesias'=>$request->get('maxcortesias'),
                    'maxcupones'=>$request->get('maxcupones'),
                    'anticipo_id'=>$request->get('anticipo_id'),
                    'idusuario'=> $request->get('idusuario'),
                    'tipounidades_id' => $tipoActividad->tipoUnidad->id, 
                    'precio' => $request->get('precio'),
                    'balance' => $request->get('balance'),
                    'promocion' => 0,
                    'combo' => 0,
                    'observaciones' => $request->get('observaciones'),
                    'requisitos' => $request->get('requisito'),
                    'riesgo' => $request->get('riesgo'),
                    'puntos' => $request->get('puntos'),
                    'libre'=> $request->get('libre'),                                         
                 ]);

                 // inserta precios
                $datosPersonas = $request->datosPersonas;
                foreach ($datosPersonas as $datoPersona ) {
                    if($datoPersona['acompanante'] == 'null') {                  
                        $datoPersona['acompanante'] = 0;
                    }
                    if($datoPersona['restriccion'] == 'null') {                  
                        $datoPersona['restriccion'] = 0;
                    }
                    if($datoPersona['promocion'] == 'null') {                  
                        $datoPersona['promocion'] = 0;
                    }                 
                    $actividadPrecio = ActividadPrecios::firstOrCreate(
                        ['actividades_id' => $actividad->id, 'persona_id' => $datoPersona['persona_id']  ], 
                        [
                        'precio1' => $datoPersona['precio1'],
                        'precio2'=> $datoPersona['precio2'],
                        'precio3'=> $datoPersona['precio3'],
                        'doble'=> $datoPersona['doble'],
                        'doblebalanc'=> $datoPersona['doblebalanc'],
                        'triple'=> $datoPersona['triple'],
                        'triplebalanc'=> $datoPersona['triplebalanc'],
                        'promocion'=> $datoPersona['promocion'],
                        'restriccion'=> $datoPersona['restriccion'],
                        'active'=> $datoPersona['active'],
                        'acompanante'=> $datoPersona['acompanante'],
                        'remove'=> $datoPersona['remove'],
                        'usuarios_id'=> $request->get('idusuario'),
                        ]
                    );
                    $actividadPrecio->save();
                }                 

                if($request->libre == 1){ //SI LIBRE ESTA CHECKEADO  ### SI SON HORARIOS ABIERTOS ###
                    $count = count($request->diasSeleccionados);
                    if($request->duracion == null){
                        $message ='El Campo Duración Debe Contener Información';
                       return response()->json(['error'=> 'true','errors'=> $message]);
                    }
                    if($count==0){ //valido que al menos 1 dia este seleccionado si no hay checkeados mando el aviso
                        $message ='Al Menos Debes de Seleccionar 1 Dia Fijo';
                       return response()->json(['error'=> 'true','errors'=> $message]);
                   
                    }
                    
                    // inserta ActividadesHorario    
                                                   
                    $ActividadesHorario = ActividadesHorario::firstOrCreate(
                        ['actividades_id' => $actividad->id],                        
                        [
                            'hini' => $request->hiniHorarioLibre,
                            'hfin' => $request->hfinHorarioLibre,
                            'l'=> $request->diasSeleccionados[0]['activado'],
                            'm'=> $request->diasSeleccionados[1]['activado'],
                            'x'=> $request->diasSeleccionados[2]['activado'],
                            'j'=> $request->diasSeleccionados[3]['activado'],
                            'v'=> $request->diasSeleccionados[4]['activado'],
                            's'=> $request->diasSeleccionados[5]['activado'],
                            'd'=> $request->diasSeleccionados[6]['activado'],
                            'active'=> 1,
                            'remove'=> 0,
                            'usuarios_id'=> $request->get('idusuario'),
                            'libre'=> $request->get('libre')                         
                        ]
                    );
                    $ActividadesHorario->save();
                    
                    // salidas
                    $SalidasLlegadasHorarioSALIDA = SalidasLlegadasHorario::firstOrCreate(
                        ['actividadeshorario_id' => $ActividadesHorario->id,'salidallegadas_id' => $request->salidas, 'salida' =>1  ], 
                        ['hora' =>null,
                        // 'salida' =>1,
                            'active' =>1,
                            'remove' =>0,                        
                            'usuarios_id' => $request->get('idusuario'),
                        ]
                    
                    );
                    // llegadas
                    $SalidasLlegadasHorarioSALIDA->save();
                    $SalidasLlegadasHorarioLLEGADA = SalidasLlegadasHorario::firstOrCreate(
                        ['actividadeshorario_id' => $ActividadesHorario->id,'salidallegadas_id' => $request->llegadas, 'salida'=>0  ], 
                        ['hora' =>null,
                        // 'salida' =>0,
                            'active' =>1,
                            'remove' =>0,                        
                            'usuarios_id' => $request->get('idusuario'),
                        ]
                    
                    );
                    $SalidasLlegadasHorarioLLEGADA->save();
                         return response()->json([ 'ok' => 'Actividad Agregada Correctamente', 'status' => 200]);                                                     
                }else{
                    if($request->libre == 0){ //valido si no hay checkeados mando el aviso
                        if (count($request->datosarray) == 0) {
                            dd($request->ArrayDeDIas,$request->datosarray);
                            $message ='Al Menos Debes de Crear o Seleccionar un Horario';
                            return response()->json(['error'=> 'true','errors'=> $message]);
                        }else{
                                //si al menos hay uno chekeado guardo en DB                            
                                for ($i=0; $i<count($request->datosarray); $i++) { 
                                    $ActividadesHorario = ActividadesHorario::create(                                               
                                        [
                                        'actividades_id' => $actividad->id,
                                        'hini' => $request->datosarray[$i][0]['hini'],
                                        'hfin' => $request->datosarray[$i][0]['hfin'],
                                        'l'=> $request->datosarray[$i][0]['dia']['l'],
                                        'm'=> $request->datosarray[$i][0]['dia']['m'],
                                        'x'=> $request->datosarray[$i][0]['dia']['x'],
                                        'j'=> $request->datosarray[$i][0]['dia']['j'],
                                        'v'=> $request->datosarray[$i][0]['dia']['v'],
                                        's'=> $request->datosarray[$i][0]['dia']['s'],
                                        'd'=> $request->datosarray[$i][0]['dia']['d'],
                                        'libre'=>0,
                                        'active'=> 1,
                                        'remove'=>0,
                                        'usuarios_id'=> $request->get('idusuario')                            
                                        ]
                                    );
                                    $ActividadesHorario->save(); 
                                    
                                    // salidas
                                    for ($s=0; $s < count($request->datosarray[$i][0]['sal']); $s++) {                                         
                                        $salidas = SalidasLlegadasHorario::create(
                                        [
                                            'hora'=> $request->datosarray[$i][0]['sal'][$s]['hor'],
                                            'salida'=> 1,
                                            'salidallegadas_id' => $request->datosarray[$i][0]['sal'][$s]['s'],
                                            'actividadeshorario_id' => $ActividadesHorario->id,
                                            'usuarios_id'=> $request->get('idusuario'),
                                            'active'=>1,
                                            'remove'=>0
                                        ]);
                                        $salidas->save();                                        
                                    }
                                    //llegadas
                                    for ($l=0; $l < count($request->datosarray[$i][0]['lle']); $l++) {                                             
                                        $llegadas = SalidasLlegadasHorario::create(
                                            [
                                                'hora'=> $request->datosarray[$i][0]['lle'][$l]['hor'],
                                                'salida'=> 0,
                                                'salidallegadas_id' => $request->datosarray[$i][0]['lle'][$l]['l'],
                                                'actividadeshorario_id' => $ActividadesHorario->id,
                                                'usuarios_id'=> $request->get('idusuario'),
                                                'active'=>1,
                                                'remove'=>0
                                            ]);
                                            $salidas->save();                                            
                                    }                                                                         
                                }
                            // for ($i=0; $i <$count2 ; $i++) {                                         
                            //     $ActividadesHorario = ActividadesHorario::create(
                            //         [
                            //         'actividades_id' => $actividad->id,
                            //         'hini' => $request->ArrayHini[$i][0],
                            //         'hfin' => $request->ArrayHrFin[$i][0],
                            //         'l'=> $request->ArrayDeDIas[$i][0],
                            //         'm'=> $request->ArrayDeDIas[$i][1],
                            //         'x'=> $request->ArrayDeDIas[$i][2],
                            //         'j'=> $request->ArrayDeDIas[$i][3],
                            //         'v'=> $request->ArrayDeDIas[$i][4],
                            //         's'=> $request->ArrayDeDIas[$i][5],
                            //         'd'=> $request->ArrayDeDIas[$i][6],
                            //         'active'=> 1,
                            //         'remove'=>0,
                            //         'usuarios_id'=> $request->get('idusuario')                            
                            //         ]
                            //     );
                            //     //  entran los puntos de llegada
                            //     $cont2= count($request->arrayHorasLlegada[$i]);
                            //     for ($j=0; $j < $cont2; $j++) {  
                            //         $SalidasLlegadasHorarioLLEGADA = SalidasLlegadasHorario::create(
                            //             ['actividadeshorario_id' => $ActividadesHorario->id,
                            //             'salidallegadas_id' => $request->arrayPuntosLlegada[$i][$j],
                            //             'salida' =>0  , 
                            //             'hora' =>$request->arrayHorasLlegada[$i][$j],
                            //             // 'salida' =>1,
                            //             'active' =>1,
                            //             'remove' =>0,                        
                            //             'usuarios_id' => $request->get('idusuario'),
                            //             ]
                                    
                            //         );
                                    
                            //     }

                            //     // entran los puntos de salida
                            //     $cont2= count($request->arrayHorasSalida[$i]);
                            //     for ($j=0; $j <$cont2; $j++) { 
                            //         $SalidasLlegadasHorarioSALIDA = SalidasLlegadasHorario::create(
                            //             ['actividadeshorario_id' => $ActividadesHorario->id,
                            //             'salidallegadas_id' => $request->arrayPuntosSalida[$i][$j],
                            //             'salida'=>1, 
                            //             'hora' =>$request->arrayHorasSalida[$i][$j],
                            //             // 'salida' =>0,
                            //             'active' =>1,
                            //             'remove' =>0,                        
                            //             'usuarios_id' => $request->get('idusuario'),
                            //             ]
                                    
                            //         );
                            //     }
                            // }
                            return response()->json(['ok'=>'Actividad Agregada Correctamente']);
                        }                            
                    }
                }               
             }
           
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function show(Actividades $actividades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividades $actividades, $id)
    {
             //    pestaña 4 $
             $obs = DB::table('actividades as ac')
             ->select('ac.riesgo', 'ac.puntos', 'ac.requisitos', 'ac.observaciones')
             ->where([['ac.id','=', $id], ['ac.active', '=', '1'], ['ac.remove', '=', '0']])
             ->get();


        $act = DB::table('actividades as ac')
        ->Join('tipoactividades as ta', 'ac.tipoactividades_id', '=', 'ta.id')
        ->Join('anticipos as an', 'ac.anticipo_id', '=', 'an.id')
        ->select('ac.id', 'ac.clave', 'ac.nombre', 'ta.id as taid', 'ta.nombre as tanombre',   'ac.fijo', 'ac.duracion', 'ac.renta', 'ac.minutoincrementa', 'ac.montoincremento', 'ac.maxcortesias', 'ac.maxcupones', 'ac.anticipo_id as anid', 'an.nombre as annombre', 'ac.libre')
       ->Where([['ac.id','=', $id], ['ac.active', '=', '1'], ['ac.remove', '=', '0']])
       ->get();


    //    balance y precio


       $actpa = DB::table('actividades as ac')
           ->select('ac.precio', 'ac.balance')
           ->where([['ac.id','=', $id], ['ac.active', '=', '1'], ['ac.remove', '=', '0']])
           ->get();
           $actp = DB::table('actividadprecios as ap')
       ->join('personas as pe', 'ap.persona_id', '=', 'pe.id')
       ->select('ap.id', 'pe.id as peid', 'pe.nombre as penombre', 'ap.precio1', 'ap.precio2', 'ap.precio3', 'ap.doble', 'ap.doblebalanc', 'ap.triple', 'ap.triplebalanc', 'ap.promocion', 'ap.restriccion', 'ap.acompanante')
       ->where([['ap.actividades_id', '=', $id],  ['ap.remove', '=', '0']])
       ->orderBy('ap.id')
       ->get();
    //    actividades horario
       $acth = DB::table('actividadeshorarios as ah')
           ->select('ah.id','ah.hini', 'ah.hfin', 'ah.l', 'ah.m', 'ah.x', 'ah.j', 'ah.v', 'ah.s', 'ah.d','ah.libre')
           ->where([ ['ah.remove','=','0'], ['ah.actividades_id', '=', $id]])
           ->orderBy('ah.hini')
           ->get();
           

            $salidasHorarioMultiple = array();
            $salidasHorarioLibre = array();
            $llegadasHorarioLibre = array();
            $llegadasHorarioMultiple =array();
           foreach ($acth as $horario) {
               //cambie el hini y hfin por libre igual a 1
               if($horario->libre==1 ) {
                    $id =$horario->id;
                    $sal = DB::table('salida_llegadahorarios as slh')
                    ->join('salidallegadas as sl', 'slh.salidallegadas_id', '=', 'sl.id')
                    ->select('slh.id', 'slh.hora', 'sl.id as slid', 'sl.direccion','slh.actividadeshorario_id')
                    ->where([['slh.actividadeshorario_id', '=',$id], ['slh.salida', '=', '1'],  ['slh.remove', '=', '0']])
                    ->orderBy('slh.id')
                    ->get();
                    array_push($salidasHorarioLibre, $sal);

            //    llegadas

                    $llegadas = DB::table('salida_llegadahorarios as slh')
                    ->join('salidallegadas as sl', 'slh.salidallegadas_id', '=', 'sl.id')
                    ->select('slh.id', 'slh.hora', 'sl.id as slid', 'sl.direccion')
                    ->where([['slh.actividadeshorario_id', '=', $id], ['slh.salida', '=', '0'],  ['slh.remove', '=', '0']])
                    ->orderBy('slh.id')
                    ->get();
                    array_push($llegadasHorarioLibre, $llegadas);
               }

            //    horario multiple
            // cambie el horario hini y hfin diferente de null a libre igual a 0
                if($horario->libre==0 ) {
                    $id =$horario->id;
                    $sal = DB::table('salida_llegadahorarios as slh')
                    ->join('salidallegadas as sl', 'slh.salidallegadas_id', '=', 'sl.id')
                    ->select('slh.id', 'slh.hora', 'sl.id as slid', 'sl.direccion')
                    ->where([['slh.actividadeshorario_id', '=',$id], ['slh.salida', '=', '1'],  ['slh.remove', '=', '0']])
                    ->orderBy('slh.id')
                    ->get();

                    array_push($salidasHorarioMultiple, $sal);

                    //legada HORARIO MULTIPLE 
                        $llegadas = DB::table('salida_llegadahorarios as slh')
                    ->join('salidallegadas as sl', 'slh.salidallegadas_id', '=', 'sl.id')
                    ->select('slh.id', 'slh.hora', 'sl.id as slid', 'sl.direccion')
                    ->where([['slh.actividadeshorario_id', '=', $id], ['slh.salida', '=', '0'], ['slh.remove', '=', '0']])
                    ->orderBy('slh.id')  
                    ->get();
                    array_push($llegadasHorarioMultiple, $llegadas);
                }
           }
        return response()->json(['pestana1'=> ['actividades'=> $act], 'pestana2'=>['balances'=> $actpa, 'precios'=> $actp], 'pestana3'=>['actividadesHorario'=> $acth, 'salidasHLibre'=>  $salidasHorarioLibre , 'llegadasHLibre'=> $llegadasHorarioLibre, 'salidasHMultiple'=>  $salidasHorarioMultiple , 'llegadasHMultiple' => $llegadasHorarioMultiple], 'pestana4'=> ['ob' => $obs], 'var'=> $acth]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

     
        //reglas de validacion
        $rules =[
            // 'clave' => ['required', 'string', 'min:5','unique:actividades'],
            'nombre' => ['required', 'string', 'max:255'],
            'tipoactividades_id'=> ['required', 'integer'],
            'fijo'=> ['nullable', 'boolean'],
            'renta' => ['nullable','boolean'],
            'active'=> ['nullable', 'boolean'],
            'remove' => ['nullable','boolean'],
            'duracion' => ['nullable','integer'],
            'minutoincrementa'=>['nullable','integer'],
            'montoincremento'=>['nullable','between:0,999999.99'],
            'maxcortesias'=>['nullable','integer'],
            'maxcupones'=>['nullable','integer'],
            'anticipo_id'=>['required','integer'],
            'idusuario'=> ['integer','required'],
            'tipounidades_id'=>['integer', 'required'],
            'precio' =>['required','between:0,999999.99'],
            'balance' =>['required','between:0,999999.99'],
            'promocion'=>['boolean','nullable'],
            'combo' =>['boolean','nullable'],
            'observaciones' =>['nullable','string'], 
            'requisitos' =>['nullable','string'],
            'riesgo' =>['nullable','boolean'],
            'puntos' =>['nullable','integer'],
            'libre'=> ['boolean'],
            'salidas'=>['integer', 'nullable'],
            'llegadas'=>['integer','nullable']            
        ];
   

     if($request->ajax())
     {
          //Se realiza la validación
          $validator = Validator::make($request->all(), $rules);
          // $result = TipoActividades::create($request->all());
          if ($validator->fails()) 
          {
            $tipoActividadId = $request->get('tipoactividades_id');
            $tipoActividad = TipoActividades::find($tipoActividadId);

            return response()->json(['error'=> 'true','errors'=>$validator->errors()->all()]); 
          }else{
            $tipoActividadId = $request->get('tipoactividades_id');
            $tipoActividad = TipoActividades::find($tipoActividadId);

            // inserta actividad
            $actividad = Actividades::where('id',$request->get('actividadid'))
            ->update([
                // 'clave' => $request->get('clave'),
                'nombre' => $request->get('nombre'),
                'tipoactividades_id'=> $request->get('tipoactividades_id'),
                'fijo'=> $request->get('fijo'),
                'renta' => $request->get('renta'),
                'active'=> $request->get('active'),
                'remove' => $request->get('remove'),
                'duracion' => $request->get('duracion'),
                'minutoincrementa'=>$request->get('minutoincrementa'),
                'montoincremento'=>$request->get('montoincremento'),
                'maxcortesias'=>$request->get('maxcortesias'),
                'maxcupones'=>$request->get('maxcupones'),
                'anticipo_id'=>$request->get('anticipo_id'),
                'idusuario'=> $request->get('idusuario'),
                'tipounidades_id' => $tipoActividad->tipoUnidad->id, 
                'precio' => $request->get('precio'),
                'balance' => $request->get('balance'),
                'promocion' => 0,
                'combo' => 0,
                'observaciones' => $request->get('observaciones'),
                'requisitos' => $request->get('requisito'),
                'riesgo' => $request->get('riesgo'),
                'puntos' => $request->get('puntos'),
                'libre'=> $request->get('libre'),                                         
             ]);
            //  $actividad->save();
             // inserta precios
            $datosPersonas = $request->datosPersonas;
            foreach ($datosPersonas as $datoPersona ) {
                if($datoPersona['acompanante'] == 'null') {                  
                    $datoPersona['acompanante'] = 0;
                }
                if($datoPersona['restriccion'] == 'null') {                  
                    $datoPersona['restriccion'] = 0;
                }
                if($datoPersona['promocion'] == 'null') {                  
                    $datoPersona['promocion'] = 0;
                }                 
                $actividadPrecio = ActividadPrecios::where('actividades_id',$request->get('actividadid'))
                ->where('persona_id', $datoPersona['persona_id'])
                ->update([
                    'precio1' => $datoPersona['precio1'],
                    'precio2'=> $datoPersona['precio2'],
                    'precio3'=> $datoPersona['precio3'],
                    'doble'=> $datoPersona['doble'],
                    'doblebalanc'=> $datoPersona['doblebalanc'],
                    'triple'=> $datoPersona['triple'],
                    'triplebalanc'=> $datoPersona['triplebalanc'],
                    'promocion'=> $datoPersona['promocion'],
                    'restriccion'=> $datoPersona['restriccion'],
                    'active'=> $datoPersona['active'],
                    'acompanante'=> $datoPersona['acompanante'],
                    'remove'=> $datoPersona['remove'],
                    'usuarios_id'=> $request->get('idusuario'),
                    ]
                );
                // $actividadPrecio->save();
            }                 

            // dd($request->libre);
            if($request->libre == 1){ //SI LIBRE ESTA CHECKEADO  ### SI SON HORARIOS ABIERTOS ###
                
                $count = count($request->diasSeleccionados);
                if($request->duracion == null){
                    $message ='El Campo Duración Debe Contener Información';
                   return response()->json(['error'=> 'true','errors'=> $message]);
                }
                if($count==0){ //valido que al menos 1 dia este seleccionado si no hay checkeados mando el aviso
                    $message ='Al Menos Debes de Seleccionar 1 Dia Fijo';
                   return response()->json(['error'=> 'true','errors'=> $message]);               
                }
                // inserta ActividadesHorario                                                    
                $ActividadesHorario = ActividadesHorario::updateOrCreate(
                    ['actividades_id' => $request->get('actividadid'), 'id'=>$request->get('horarioLibreId')],                        
                    [
                        'hini' => $request->hiniHorarioLibre,
                        'hfin' => $request->hfinHorarioLibre,
                        'l'=> $request->diasSeleccionados[0]['activado'],
                        'm'=> $request->diasSeleccionados[1]['activado'],
                        'x'=> $request->diasSeleccionados[2]['activado'],
                        'j'=> $request->diasSeleccionados[3]['activado'],
                        'v'=> $request->diasSeleccionados[4]['activado'],
                        's'=> $request->diasSeleccionados[5]['activado'],
                        'd'=> $request->diasSeleccionados[6]['activado'],
                        'active'=> 1,
                        'remove'=>0,
                        'usuarios_id'=> $request->get('idusuario'),
                        'libre'=> $request->get('libre')                          
                    ]
                );
                $ActividadesHorario->save(); 
                // salidas
              
                $SalidasLlegadasHorarioSALIDA = SalidasLlegadasHorario::updateOrCreate(
                    ['id' => $request->salidaId ], 
                    ['hora' =>null,
                    'salida' =>1,
                    'active' =>1,
                    'remove' =>0,
                    'salidallegadas_id'=>$request->salidas,                        
                    'actividadeshorario_id'=>$ActividadesHorario->id,
                    'usuarios_id' => $request->get('idusuario'),
                    ]
                
                );                
                // llegadas
                $SalidasLlegadasHorarioSALIDA->save();
                $SalidasLlegadasHorarioLLEGADA = SalidasLlegadasHorario::updateOrCreate(
                    ['id' => $request->llegadaId], 
                    ['hora' =>null,
                    'salida' =>0,
                    'active' =>1,
                    'remove' =>0,
                    'salidallegadas_id'=>$request->llegadas,
                    'actividadeshorario_id'=>$ActividadesHorario->id,                        
                    'usuarios_id' => $request->get('idusuario'),
                    ]                
                );
                $SalidasLlegadasHorarioLLEGADA->save();

                     return response()->json([ 'ok' => 'Actividad Agregada Correctamente', 'status' => 200]);                                                     
            }else{
                if($request->libre == 0){ //valido si no hay checkeados mando el aviso
                    if (count($request->ArrayDeDIas) == 0) {
                        $message ='Al Menos Debes de Crear o Seleccionar un Horario';
                        return response()->json(['error'=> 'true','errors'=> $message]);
                    }else{
                            //si al menos hay uno chekeado guardo en DB
                             //si al menos hay uno chekeado guardo en DB
                             for ($i=0; $i < count($request->datosarray); $i++) { 
                                // if ($request->datosarray[$i][0]['cont']>0) {
                                if($request->datosarray[$i][0]['id']>0){
                                        $ActividadesHorario = ActividadesHorario::where('id', $request->datosarray[$i][0]['id'])
                                    ->update([
                                        'hini' => $request->datosarray[$i][0]['hini'],
                                        'hfin' => $request->datosarray[$i][0]['hfin'],
                                        'l'=> $request->datosarray[$i][0]['dia']['l'],
                                        'm'=> $request->datosarray[$i][0]['dia']['m'],
                                        'x'=> $request->datosarray[$i][0]['dia']['x'],
                                        'j'=> $request->datosarray[$i][0]['dia']['j'],
                                        'v'=> $request->datosarray[$i][0]['dia']['v'],
                                        's'=> $request->datosarray[$i][0]['dia']['s'],
                                        'd'=> $request->datosarray[$i][0]['dia']['d'],
                                        'usuarios_id'=> $request->get('idusuario')                             
                                        ]
                                    );
                                        // salidas
                                        for ($s=0; $s < count($request->datosarray[$i][0]['sal']); $s++) { 
                                            if ($request->datosarray[$i][0]['sal'][$s]['idsal']>0) {
                                                $salidas = SalidasLlegadasHorario::where('id',$request->datosarray[$i][0]['sal'][$s]['idsal'])
                                                ->update([
                                                    'hora'=> $request->datosarray[$i][0]['sal'][$s]['hor'],
                                                     'salidallegadas_id' => $request->datosarray[$i][0]['sal'][$s]['s'],
                                                     'usuarios_id'=> $request->get('idusuario')  
                                                ]);
                                            }
                                            else{
                                                dd( $request->datosarray[$i][0]['id']);
                                                $salidas = SalidasLlegadasHorario::create(
                                                [
                                                    'hora'=> $request->datosarray[$i][0]['sal'][$s]['hor'],
                                                    'salida'=> 1,
                                                    'salidallegadas_id' => $request->datosarray[$i][0]['sal'][$s]['s'],
                                                    'actividadeshorario_id' => $request->datosarray[$i][0]['id'],
                                                    'usuarios_id'=> $request->get('idusuario'),
                                                    'active'=>1,
                                                    'remove'=>0
                                                ]);
                                                $salidas->save();
                                            }
                                        }
                                        // $salidas = SalidasLlegadasHorario::where()
                                        // llegadas
                                        for ($l=0; $l < count($request->datosarray[$i][0]['lle']); $l++) { 
                                            if($request->datosarray[$i][0]['lle'][$l]['id']>0){
                                                $llegadas = SalidasLlegadasHorario::where('id',$request->datosarray[$i][0]['lle'][$l]['id'])
                                                ->update([
                                                    'hora'=> $request->datosarray[$i][0]['lle'][$l]['hor'],
                                                     'salidallegadas_id' => $request->datosarray[$i][0]['lle'][$l]['l'],
                                                     'usuarios_id'=> $request->get('idusuario')  
                                                ]);    
                                            }else{
                                                $llegadas = SalidasLlegadasHorario::create(
                                                    [
                                                        'hora'=> $request->datosarray[$i][0]['lle'][$l]['hor'],
                                                        'salida'=> 0,
                                                        'salidallegadas_id' => $request->datosarray[$i][0]['lle'][$l]['l'],
                                                        'actividadeshorario_id' => $request->datosarray[$i][0]['id'],
                                                        'usuarios_id'=> $request->get('idusuario'),
                                                        'active'=>1,
                                                        'remove'=>0
                                                    ]);
                                                    $salidas->save();
                                            }
                                        }
                                    // }
                                }else{
                                    // inserta ActividadesHorario    
                                    $ActividadesHorario = ActividadesHorario::create(                                               
                                        [
                                        'actividades_id' => $request->get('actividadid'),
                                        'hini' => $request->datosarray[$i][0]['hini'],
                                        'hfin' => $request->datosarray[$i][0]['hfin'],
                                        'l'=> $request->datosarray[$i][0]['dia']['l'],
                                        'm'=> $request->datosarray[$i][0]['dia']['m'],
                                        'x'=> $request->datosarray[$i][0]['dia']['x'],
                                        'j'=> $request->datosarray[$i][0]['dia']['j'],
                                        'v'=> $request->datosarray[$i][0]['dia']['v'],
                                        's'=> $request->datosarray[$i][0]['dia']['s'],
                                        'd'=> $request->datosarray[$i][0]['dia']['d'],
                                        'libre'=>0,
                                        'active'=> 1,
                                        'remove'=>0,
                                        'usuarios_id'=> $request->get('idusuario')                            
                                        ]
                                    );
                                    $ActividadesHorario->save();     
                                    
                                    // salidas
                                    // dd($ActividadesHorario->id);
                                    for ($s=0; $s < count($request->datosarray[$i][0]['sal']); $s++) {                                         
                                        $salidas = SalidasLlegadasHorario::create(
                                        [
                                            'hora'=> $request->datosarray[$i][0]['sal'][$s]['hor'],
                                            'salida'=> 1,
                                            'salidallegadas_id' => $request->datosarray[$i][0]['sal'][$s]['s'],
                                            'actividadeshorario_id' => $ActividadesHorario->id,
                                            'usuarios_id'=> $request->get('idusuario'),
                                            'active'=>1,
                                            'remove'=>0
                                        ]);
                                        $salidas->save();                                        
                                    }
                                    //llegadas
                                    for ($l=0; $l < count($request->datosarray[$i][0]['lle']); $l++) {                                             
                                        $llegadas = SalidasLlegadasHorario::create(
                                            [
                                                'hora'=> $request->datosarray[$i][0]['lle'][$l]['hor'],
                                                'salida'=> 0,
                                                'salidallegadas_id' => $request->datosarray[$i][0]['lle'][$l]['l'],
                                                'actividadeshorario_id' => $ActividadesHorario->id,
                                                'usuarios_id'=> $request->get('idusuario'),
                                                'active'=>1,
                                                'remove'=>0
                                            ]);
                                            $salidas->save();                                            
                                    }   

                                }
                            }
                        return response()->json(['ok'=>'Actividad Agregada Correctamente']);
                    }                            
                }
            }               
         }
       
     }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if($request->ajax()){
           

            
            if( $actividad = Actividades::find($id)->delete()){
              
                return response()->json(['status'=>200,'response' => 'Actividad Eliminada Correctamente']);
            }else{
                
                return response()->json(['status'=>200,'response' => 'No se Pudo Eliminar la Actividad']);
            }

       

        }
    }
    public function salidasllegadas(Request $request)
    {
        $salidasLlegadas = SalidasLlegadas::all();

     
            return compact('salidasLlegadas');
        
    }
    public function horarioMultiple(Request $request, $id)
    {
          
            
             //actividades horario
            $acth = DB::table('actividadeshorarios as ah')
            ->select('ah.id','ah.hini', 'ah.hfin', 'ah.l', 'ah.m', 'ah.x', 'ah.j', 'ah.v', 'ah.s', 'ah.d')
            ->where([['ah.active','=','1'], ['ah.remove','=','0'], ['ah.actividades_id', '=', $id]])
            ->orderBy('ah.hini')
            ->get();
 
             $salidasHorarioMultiple = array();
             $llegadasHorarioMultiple =array();
            foreach ($acth as $horario) {
             //    horario multiple
             if($horario->hini != null && $horario->hfin != null ) {
                 $idh =$horario->id;
                 $sal = DB::table('salida_llegadahorarios as slh')
                ->join('salidallegadas as sl', 'slh.salidallegadas_id', '=', 'sl.id')
                ->select('slh.id','slh.actividadeshorario_id', 'slh.hora', 'sl.id as slid', 'sl.direccion')
                ->where([['slh.actividadeshorario_id', '=',$idh], ['slh.salida', '=', '1'], ['slh.active', '=', '1'], ['slh.remove', '=', '0']])
                ->orderBy('slh.id')
                ->get();
 
                array_push($salidasHorarioMultiple, $sal);
 
                //legada HORARIO MULTIPLE 
                $llegadas = DB::table('salida_llegadahorarios as slh')
            ->join('salidallegadas as sl', 'slh.salidallegadas_id', '=', 'sl.id')
            ->select('slh.id', 'slh.hora','slh.actividadeshorario_id', 'sl.id as slid', 'sl.direccion')
            ->where([['slh.actividadeshorario_id', '=', $idh], ['slh.salida', '=', '0'], ['slh.active', '=', '1'], ['slh.remove', '=', '0']])
            ->orderBy('slh.id')
            ->get();
            array_push($llegadasHorarioMultiple, $llegadas);
                }
                
            }
 
         return response()->json(['pestana3'=>['actividadesHorario'=> $acth, 'salidasHMultiple'=>  $salidasHorarioMultiple , 'llegadasHMultiple' => $llegadasHorarioMultiple]]);
         
      

    }
    public function updateActividad(Request $request, $id) {

      
        if($request->ajax()){
            $actividad = Actividades::find($id);
            if($request->desactivar == 1){
                $actividad::where('id', $request->id)
                                ->update(['active' => 0]);
                return response()->json(['status'=>200,'response' => 'Actividad Desactivada Correctamente']);
            }else{
                $actividad::where('id', $request->id)
                ->update(['active' => 1]);
                return response()->json(['status'=>200,'response' => 'Actividad Activada Correctamente']);
            }
        }
    }


    public function deshabilitarActividad(Request $request, $id){

        $actividad = Actividades::find($id);
    
        if($request->ajax()){
           
        if($actividad->libre==1){
            $actividad::where('id', $id)->update(['libre' => 0, ]);
            $ch = ActividadesHorario::where('libre', '1')
            ->where('actividades_id', $id)
            ->update(['active'=> 0]);
         
            
            return response()->json(['message'=>'Desactivada Correctamente']);
        } 
        if($actividad->libre==0){
            $actividad::where('id', $id)->update(['libre' => 1]);
            $ch = ActividadesHorario::where('libre', '1')
            ->where('actividades_id', $id)
            ->update(['active'=>1]);
            return response()->json(['message'=>'Activada Correctamente']);
        }
    }
    }
    public function statusActividad(Request $request, $id){
        
        
         
        $actividad = Actividades::find($id);
       
        if($actividad->libre==1){
            
            return response()->json(['message'=>'Habilitada']);
        } 
        if($actividad->libre==0){
            
            return response()->json(['message'=>'Deshabilitada']);
           
        }
    }
}