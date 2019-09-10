<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anticipos;
use App\TipoActividades;
use Validator;
use App\Actividades;
use App\Personas;
use App\ComboDet;
use App\ActividadPrecios;
use Illuminate\Support\Facades\DB;


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
    public function store(Request $request)
    {
           //reglas de validacion
           $rules =[
            'clave' => ['required', 'string', 'min:5','unique:actividades'],
            'nombre' => ['required', 'string', 'max:255'],
            'tipoactividades_id'=> ['required', 'integer'],
            'active'=> ['nullable', 'boolean'],
            'remove' => ['nullable','boolean'],
            'maxcortesias'=>['nullable','integer'],
            'maxcupones'=>['nullable','integer'],
            'anticipo_id'=>['required','integer'],
            'idusuario'=> ['integer','required'],
            'libre'=> ['boolean','nullable'],
            'combo'=> ['boolean','nullable']
        ];
       
             //Se realiza la validación
             $validator = Validator::make($request->all(), $rules);
             if($validator->fails()){
                return response()->json(['errors'=> $validator->errors()->all()]);
             }else{
                 $act = Actividades::create([
                    'clave' => $request['clave'],
                    'nombre' => $request['nombre'],
                    'tipoactividades_id' =>$request['tipoactividades_id'],
                    'active'=> '1',
                    'remove' => '0',
                    'maxcortesias'=>$request['maxcortesias'],
                    'maxcupones'=>$request['maxcupones'],
                    'anticipo_id'=>$request['anticipo_id'],
                    'idusuario'=> $request['idusuario'],
                    'libre'=> $request['libre'],
                    'combo'=> '1',
                    'precio' => $request->get('precio'),
                    'balance' => $request->get('balance'),
                    'fijo'=>0,
                    'renta'=>0,
                    'promocion' => 0,
                    'riesgo'=>0,
                    'tipounidades_id'=>1                     
                     ]);
                    //  dd($request->get('dataSet')[0]['hfin']);
                     if($act){
                         for ($h=0; $h < count($request->get('dataSet')); $h++) { 
                            $cDet = ComboDet::create([
                                'hini' => $request->get('dataSet')[$h]['hini'],
                                'hfin' =>$request->get('dataSet')[$h]['hfin'],
                                'actividades_id'=>$request->get('dataSet')[$h]['actividades_id'],
                                'horario_id' =>$request->get('dataSet')[$h]['horario_id'],
                                'usuarios_id'=>$request['idusuario'],
                                'actividades_id_combo'=>$act->id,
                                'active'=>'1',
                                'remove'=>'0'
                            ]);
                         }
                 
                      
                        
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
                        ['actividades_id' => $act->id, 'persona_id' => $datoPersona['persona_id']  ], 
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



                        return response()->json(['message' => 'Combo Guardado']);
                     }else{
                        return response()->json(['message'=>'Error Al Guardar']);
                     }
             }
           
            
             
        

        
     
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
        $actividades = DB::table('actividades as ac')
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
         
        
         $arrHLibres =array();
         $arrHMultiple = array();
        //  array_push($arrHLibres, dato)
        $length = $ach->count();
        for ($i=0; $i < $length; $i++) { 

            if($ach[$i]->libre == 1) {

                array_push($arrHLibres, $ach[$i]);

            } else if($ach[$i]->libre == 0) {

                array_push($arrHMultiple,$ach[$i]);

            }
        
        }

        if(count($arrHLibres) > 0){
            return response()->json(['infoactivad' => $actividades, 'infoactiviadhorario'=> $arrHLibres,'activiadadPrecios'=>$actp]);
        }else{
            return response()->json(['infoactivad' => $actividades, 'infoactiviadhorario'=> $arrHMultiple,'activiadadPrecios'=>$actp]);
        }
        
      
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
       
        $actividades = DB::table('actividades as ac')
        ->select('ac.id', 'ac.clave', 'ac.nombre','ac.precio','ac.balance', 'ac.duracion')
        ->where([['ac.active', '=','1'], ['ac.remove','=','0'], ['ac.renta','=','0'], ['ac.id','=',$id],['ac.combo','=','0']])
        ->orderBy('ac.clave')
        ->get();
      

        $ach = DB::table('actividadeshorarios as ach')
        ->select('ach.id','ach.actividades_id','ach.libre','ach.hini','ach.hfin', DB::raw('concat ( substring(ach.hini,1,5), " | ", substring(ach.hfin,1,5), " | ", IF(ach.l=1, "L", ""), IF(ach.l=m, " M", ""), IF(ach.x=1, " X", ""), IF(ach.j=1, " J", ""), IF(ach.v=1, " V", ""), IF(ach.s=1, " S", ""), IF(ach.d=1, " D", "")) as horario'))
        ->where([['ach.active','=','1'],['ach.remove','=','0'], ['ach.actividades_id','=',$id]])
        ->orderBy('ach.id')
        ->get();   
        
         $arrHLibres =array();
         $arrHMultiple = array();
        //  array_push($arrHLibres, dato)
        $length = $ach->count();
        for ($i=0; $i < $length; $i++) { 

            if($ach[$i]->libre == 1) {

                array_push($arrHLibres, $ach[$i]);

            } else if($ach[$i]->libre == 0) {

                array_push($arrHMultiple,$ach[$i]);

            }
        
        }

        if(count($arrHLibres) > 0){
            return response()->json(['infoactivad' => $actividades, 'infoactiviadhorario'=> $arrHLibres]);
        }else{
            return response()->json(['infoactivad' => $actividades, 'infoactiviadhorario'=> $arrHMultiple]);
        }
        
      
    }


   
  
}
