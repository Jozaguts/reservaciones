<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anticipos;
use App\TipoActividades;
use Validator;
use App\Actividades;
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

        $anticipos = Anticipos::all();
        $tipoactividades = TipoActividades::all();
         $actividades = DB::table('actividades as ac')
               ->select('ac.id', 'ac.clave', 'ac.nombre','ac.tipoactividades_id','ac.active','ac.precio', 'ac.balance')
               ->where([['ac.active', '=','1'], ['ac.remove','=','0'], ['ac.renta','=','0']])
               ->orderBy('ac.clave')
               ->get();
            
        return view('sections.activities.combos',compact('anticipos','tipoactividades','actividades'));
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
                    'precio'=> '1',
                    'balance'=> '1',
                    'fijo'=>0,
                    'renta'=>0,
                    'promocion' => 0,
                    'riesgo'=>0,
                    'tipounidades_id'=>1
                     
                     ]);

                     if($act){
                        return response()->json(['message', 'Combo Guardado']);
                     }else{
                        return response()->json(['message', 'Error Al Guardar']);
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
        //
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
        ->where([['ac.active', '=','1'], ['ac.remove','=','0'], ['ac.renta','=','0'], ['ac.id','=',$id]])
        ->orderBy('ac.clave')
        ->get();

        $ach = DB::table('actividadeshorarios as ach')
        ->select('ach.id','ach.actividades_id','ach.libre','ach.hini','ach.hfin', DB::raw('concat(ach.hini, " | ", ach.hfin, " | ", IF(ach.l=1, "L", ""), IF(ach.l=m, " M", ""), IF(ach.x=1, " X", ""), IF(ach.j=1, " J", ""), IF(ach.v=1, " V", ""), IF(ach.s=1, " S", ""), IF(ach.d=1, " D", "")) as horario'))
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
