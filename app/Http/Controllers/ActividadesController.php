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
use DB;


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
                    
                    //si al menos hay uno chekeado guardo en DB
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
                 
                        $ActividadesHorario = ActividadesHorario::firstOrCreate(
                            ['actividades_id' => $actividad->id],
                            
                            [
                            'hini' => null,
                            'hfin' => null,
                            'l'=> $request->diasSeleccionados[0]['activado'],
                            'm'=> $request->diasSeleccionados[1]['activado'],
                            'x'=> $request->diasSeleccionados[2]['activado'],
                            'j'=> $request->diasSeleccionados[3]['activado'],
                            'v'=> $request->diasSeleccionados[4]['activado'],
                            's'=> $request->diasSeleccionados[5]['activado'],
                            'd'=> $request->diasSeleccionados[6]['activado'],
                            'active'=> 1,
                            'remove'=>0,
                            'usuarios_id'=> $request->get('idusuario')                            
                            ]
                        );
                        $ActividadesHorario->save();


                        $SalidasLlegadasHorarioSALIDA = SalidasLlegadasHorario::firstOrCreate(
                            ['actividadeshorario_id' => $ActividadesHorario->id,'salidallegadas_id' => $request->salidas, 'salida' =>1  ], 
                            ['hora' =>null,
                            // 'salida' =>1,
                             'active' =>1,
                             'remove' =>0,                        
                             'usuarios_id' => $request->get('idusuario'),
                            ]
                        
                        );
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
                 }
                
                    
                }else{
                    if($request->libre == 0){ //valido si no hay checkeados mando el aviso
                        if (count($request->ArrayDeDIas) == 0) {
                            $message ='Al Menos Debes de Crear o Seleccionar un Horario';
                            return response()->json(['error'=> 'true','errors'=> $message]);
                        }else{
                    //si al menos hay uno chekeado guardo en DB
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
            $count2 = count($request->ArrayDeDIas);
      
                for ($i=0; $i <$count2 ; $i++) { 
                    
                    
                    $ActividadesHorario = ActividadesHorario::create(
                        [
                        'actividades_id' => $actividad->id,
                        'hini' => $request->ArrayHini[$i][0],
                        'hfin' => $request->ArrayHrFin[$i][0],
                        'l'=> $request->ArrayDeDIas[$i][0],
                        'm'=> $request->ArrayDeDIas[$i][1],
                        'x'=> $request->ArrayDeDIas[$i][2],
                        'j'=> $request->ArrayDeDIas[$i][3],
                        'v'=> $request->ArrayDeDIas[$i][4],
                        's'=> $request->ArrayDeDIas[$i][5],
                        'd'=> $request->ArrayDeDIas[$i][6],
                        'active'=> 1,
                        'remove'=>0,
                        'usuarios_id'=> $request->get('idusuario')                            
                        ]
                    );
                    //  entran los puntos de llegada
                    $cont2= count($request->arrayHorasLlegada[$i]);
                    for ($j=0; $j < $cont2; $j++) {  
                        $SalidasLlegadasHorarioLLEGADA = SalidasLlegadasHorario::create(
                            ['actividadeshorario_id' => $ActividadesHorario->id,
                            'salidallegadas_id' => $request->arrayPuntosLlegada[$i][$j],
                            'salida' =>0  , 
                            'hora' =>$request->arrayHorasLlegada[$i][$j],
                            // 'salida' =>1,
                            'active' =>1,
                            'remove' =>0,                        
                            'usuarios_id' => $request->get('idusuario'),
                            ]
                        
                        );
                        
                    }

                    // entran los puntos de salida
                    $cont2= count($request->arrayHorasSalida[$i]);
                    for ($j=0; $j <$cont2; $j++) { 
                        $SalidasLlegadasHorarioSALIDA = SalidasLlegadasHorario::create(
                            ['actividadeshorario_id' => $ActividadesHorario->id,
                            'salidallegadas_id' => $request->arrayPuntosSalida[$i][$j],
                            'salida'=>1, 
                            'hora' =>$request->arrayHorasSalida[$i][$j],
                            // 'salida' =>0,
                            'active' =>1,
                            'remove' =>0,                        
                            'usuarios_id' => $request->get('idusuario'),
                            ]
                        
                        );
                        
                        
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
    public function edit(Request $request, $id)
    {
         $act = DB::table('actividades as ac')
        ->Join('tipoactividades as ta', 'ac.tipoactividades_id', '=', 'ta.id')
        ->Join('anticipos as an', 'ac.anticipo_id', '=', 'an.id')
        ->select('ac.id', 'ac.clave', 'ac.nombre', 'ta.id as taid', 'ta.nombre as tanombre',   'ac.fijo', 'ac.duracion', 'ac.renta', 'ac.minutoincrementa', 'ac.montoincremento', 'ac.maxcortesias', 'ac.maxcupones', 'ac.anticipo_id as anid', 'an.nombre as annombre')
       ->Where([['ac.id','=', $id], ['ac.active', '=', '1'], ['ac.remove', '=', '0']])
       ->get();

    //    balance y precio

       $actpa = DB::table('actividades as ac')
                  ->select('ac.precio', 'ac.balance')
                  ->where([['ac.id','=', $id], ['ac.active', '=', '1'], ['ac.remove', '=', '0']])
                  ->get();
            
                //   precios
$actp = DB::table('actividadprecios as ap')
       ->join('personas as pe', 'ap.persona_id', '=', 'pe.id')
       ->select('ap.id', 'pe.id as peid', 'pe.nombre as penombre', 'ap.precio1', 'ap.precio2', 'ap.precio3', 'ap.doble', 'ap.doblebalanc', 'ap.triple', 'ap.triplebalanc', 'ap.promocion', 'ap.restriccion', 'ap.acompanante')
       ->where([['ap.actividades_id', '=', $id], ['ap.active', '=', '1'], ['ap.remove', '=', '0']])
       ->orderBy('ap.id')
       ->get();
    

        return response()->json(['pestana1' => ['actividades'=> $act], 'pestana2' => ['balances' => $actpa, 'precios' => $actp]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actividades $actividades)
    {
        //
    }
    public function salidasllegadas(Request $request)
    {
        $salidasLlegadas = SalidasLlegadas::all();

     
            return compact('salidasLlegadas');
        
    }
}
