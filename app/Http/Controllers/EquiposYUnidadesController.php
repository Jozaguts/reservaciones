<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\EquiposYUnidades;
use Validator;
use App\TipoUnidad;
use App\Dias;
use App\UnidadesHorario;
use Faker\Factory as Faker;
class EquiposYUnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $unidades = EquiposYUnidades::all(); //mando la unidad
        $tipounidades = TipoUnidad::orderBy('nombre', 'asc')->get();// mando la categoria de la unidad
        $dias = Dias::all();
        return view('sections.activities.equiposyunidades', compact('unidades','tipounidades', 'dias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'clave' => ['required', 'string', 'max:5'],
            'placa' => ['required', 'string', 'max:16'],
            'capacidad'=> ['required', 'string'],
            'descripcion'=> ['required', 'string'],
            'color'=> ['required', 'string'],
            'idusuario'=> ['required', 'integer'],
            'idtipounidad'=> ['nullable', 'integer'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],

        ];
    
     //Se realiza la validación
     $validator = Validator::make($request->all(), $rules);
                    
         //si falla se redirige con los errores a la vista
         if ($validator->fails()) {
             return response()->json(['success'=>'false','error'=>$validator->errors()->all()]);  
         }
         if($request->ajax())
         {            

             $unidad = EquiposYUnidades::create($request->all());
             $unidad_id = $unidad->id;
            
             if ($unidad) {

                 //  asignamos los ohrarios
        $horario = new UnidadesHorario;

        $totalDias = $request->totalDias;

        $todosLosDias = $request->todosLosDias;
        if($todosLosDias==1){
            // Lunes
            $horario::create([
                'dia'=> 'L',
                'idtipounidad'=> $request->input('idtipounidad'),
                'hini'=> $request->input('iTD'),
                'hfin'=>$request->input('fTD'),
                'active'=>1,
                'remove'=>0,
                'idusuario'=>$request->input('idusuario'), 
                'unidades_id' => $unidad_id 
            ]);
             // Martes
             $horario::create([
                'dia'=> 'M',
                'idtipounidad'=> $request->input('idtipounidad'),
                'hini'=> $request->input('iTD'),
                'hfin'=>$request->input('fTD'),
                'active'=>1,
                'remove'=>0,
                'idusuario'=>$request->input('idusuario'), 
                'unidades_id' => $unidad_id 
            ]);
             // Miercoles
             $horario::create([
                'dia'=> 'X',
                'idtipounidad'=> $request->input('idtipounidad'),
                'hini'=> $request->input('iTD'),
                'hfin'=>$request->input('fTD'),
                'active'=>1,
                'remove'=>0,
                'idusuario'=>$request->input('idusuario'), 
                'unidades_id' => $unidad_id  
            ]);
             // Jueves
             $horario::create([
                'dia'=> 'J',
                'idtipounidad'=> $request->input('idtipounidad'),
                'hini'=> $request->input('iTD'),
                'hfin'=>$request->input('fTD'),
                'active'=>1,
                'remove'=>0,
                'idusuario'=>$request->input('idusuario'), 
                'unidades_id' => $unidad_id  
            ]);
             // Viernes
             $horario::create([
                'dia'=> 'V',
                'idtipounidad'=> $request->input('idtipounidad'),
                'hini'=> $request->input('iTD'),
                'hfin'=>$request->input('fTD'),
                'active'=>1,
                'remove'=>0,
                'idusuario'=>$request->input('idusuario'), 
                'unidades_id' => $unidad_id 
            ]);
             // Sabado
             $horario::create([
                'dia'=> 'S',
                'idtipounidad'=> $request->input('idtipounidad'),
                'hini'=> $request->input('iTD'),
                'hfin'=>$request->input('fTD'),
                'active'=>1,
                'remove'=>0,
                'idusuario'=>$request->input('idusuario'), 
                'unidades_id' => $unidad_id 
            ]);
             // Domingo
             $horario::create([
                'dia'=> 'D',
                'idtipounidad'=> $request->input('idtipounidad'),
                'hini'=> $request->input('iTD'),
                'hfin'=>$request->input('fTD'),
                'active'=>1,
                'remove'=>0,
                'idusuario'=>$request->input('idusuario'), 
                'unidades_id' => $unidad_id 
            ]);

        // agregamos dia por dia
        }else{
            
            // Lunes
            $lunes = $request->Lunes;
            if($lunes == 'L'){
                $horario::create([
                    'dia'=> 'L',
                    'idtipounidad'=> $request->input('idtipounidad'),
                    'hini'=> $request->input('ilunes'),
                    'hfin'=>$request->input('flunes'),
                    'active'=>1,
                    'remove'=>0,
                    'idusuario'=>$request->input('idusuario'), 'unidades_id' => $unidad_id 
                ]);
            }
            // Martes
            $martes = $request->Martes;
            if($martes == 'M'){
                $horario::create([
                    'dia'=> 'M',
                    'idtipounidad'=> $request->input('idtipounidad'),
                    'hini'=> $request->input('imartes'),
                    'hfin'=>$request->input('fmartes'),
                    'active'=>1,
                    'remove'=>0,
                    'idusuario'=>$request->input('idusuario'), 'unidades_id' => $unidad_id 
                ]);
            }
             // Miercoles
             $miercoles = $request->Miercoles;
             if($miercoles == 'X'){
                 $horario::create([
                     'dia'=> 'X',
                     'idtipounidad'=> $request->input('idtipounidad'),
                     'hini'=> $request->input('imiercoles'),
                     'hfin'=>$request->input('fmiercoles'),
                     'active'=>1,
                     'remove'=>0,
                     'idusuario'=>$request->input('idusuario'), 'unidades_id' => $unidad_id 
                 ]);
             }
              // Jueves
            $jueves = $request->Jueves;
            if($jueves == 'J'){
                $horario::create([
                    'dia'=> 'J',
                    'idtipounidad'=> $request->input('idtipounidad'),
                    'hini'=> $request->input('ijueves'),
                    'hfin'=>$request->input('fjueves'),
                    'active'=>1,
                    'remove'=>0,
                    'idusuario'=>$request->input('idusuario'), 'unidades_id' => $unidad_id 
                ]);
            }
             // Viernes
             $viernes = $request->Viernes;
             if($viernes == 'V'){
                 $horario::create([
                     'dia'=> 'V',
                     'idtipounidad'=> $request->input('idtipounidad'),
                     'hini'=> $request->input('iviernes'),
                     'hfin'=>$request->input('fviernes'),
                     'active'=>1,
                     'remove'=>0,
                     'idusuario'=>$request->input('idusuario'), 'unidades_id' => $unidad_id 
                 ]);
             }
              // sabado
            $sabado = $request->Sabado;
            if($sabado == 'S'){
                $horario::create([
                    'dia'=> 'S',
                    'idtipounidad'=> $request->input('idtipounidad'),
                    'hini'=> $request->input('isabado'),
                    'hfin'=>$request->input('fsabado'),
                    'active'=>1,
                    'remove'=>0,
                    'idusuario'=>$request->input('idusuario'), 
                    'unidades_id' => $unidad_id 
                ]);
            }
            // domingo
            $domingo = $request->Domingo;
            if($domingo == 'D'){
                $horario::create([
                    'dia'=> 'D',
                    'idtipounidad'=> $request->input('idtipounidad'),
                    'hini'=> $request->input('idomingo'),
                    'hfin'=>$request->input('fdomingo'),
                    'active'=>1,
                    'remove'=>0,
                    'idusuario'=>$request->input('idusuario'), 
                    'unidades_id' => $unidad_id 
                ]);
            }


            
        }





                 return response()->json(['success'=>'true', 200, 'correcto' => 'Agregado Correctamente', 200]);
             }else{
                 return response()->json(['success'=>'error', 'message'=>'No se puedo Agrear la Unidad' ]);
             }
       
         }else{
             return "Error al Metodo no encotrado";
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
        $unidad = EquiposYUnidades::find($id); 
        

        // return response()->json($equipounidad);
        $unidad_horario = DB::table('unidades as u')
        ->join('unidadeshorario as uh', 'u.id','=','uh.unidades_id')
        ->select('uh.dia','uh.hini','uh.hfin','uh.id')
        ->where('u.id', '=',$id)
        ->get();
        return response()->json(['unidad'=>$unidad,'unidadHorario'=> $unidad_horario]);
       
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
        
        
        $unidad = EquiposYUnidades::find($id);
        
        $horarios = UnidadesHorario::where('unidades_id','=', $id)->get();
        
         //reglas de validacion
         $rules =[
            'clave' => [ 'string', 'max:5'],
            'placa' => [ 'string', 'max:255'],
            'capacidad'=> [ 'string'],
            'descripcion'=> [ 'string'],
            'color'=> [ 'string'],
            'idusuario'=> [ 'integer'],
            'idtipounidad'=> ['nullable', 'integer'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
        ];
           
      
      if($request->ajax())
      {
        
       
            //Se realiza la validación
        $validator = Validator::make($request->all(), $rules);
        
        //si falla se redirige con los errores a la vista
        if ($validator->fails()) {
            return redirect('tipounidades')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $inputs = $request->all();
            
            $unidad::updateOrCreate(['clave' => $request->get('clave'),
                        'placa'=> $request->get('placa'),
                        'capacidad'=> $request->get('capacidad'),
                        'descripcion'=> $request->get('descripcion'),
                        'color'=> $request->get('color'),
                        'idtipounidad'=> $request->get('idtipounidad'),              
                        'remove'=>$request->get('remove'),
                        'active'=>$request->get('active'),
                        'idusuario'=>$request->get('idusuario'), 
                        
                       ]);
                       $unidad->save();

                        $filas = 7;                        

                        for ($i=1; $i <$filas+1 ; $i++) { 
                           
                           $dias = $request->get('dias');
                           
                            if($dias[$i-1][1] != null && $dias[$i-1][2] != null ){
                                $unidad_dia = UnidadesHorario::where('unidades_id', $id)
                                ->where('dia', $dias[$i-1][0])
                                ->update(['hini' => $dias[$i-1][1],'hfin' => $dias[$i-1][2]]);
                                if ($unidad_dia<1) {
                                    UnidadesHorario::create([
                                    'dia'=> $dias[$i-1][0],
                                    'hini' => $dias[$i-1][1],
                                    'hfin' => $dias[$i-1][2],
                                    'active'=>1,
                                    'remove'=>0,
                                    'unidades_id'=> $id,
                                    'idusuario'=>$request->get('idusuario'),
                                    'idtipounidad'=>$request->get('idtipounidad')])
                                    ->save();
                                }

                            }else{
                                
                              $unidad_dia =   DB::table('unidadeshorario')->where('unidades_id', $id)
                              ->where('dia','=',$dias[$i-1][0])
                              ->delete();
                             
                                if($unidad_dia == null){
                                    return response()->json(['success'=>'false','error'=>'Error no se Puedo Eliminar la Unidad/Equipo']); 
                                }else{
                                    return response()->json(['success'=>'true', 200, 'correcto' => 'Unidad Eliminada Correctamente', 200]);
                                }
                                
                            }
  
                        }

                       foreach ( $horarios as $horario ) {
                      
                       
                        if($horario->dia == 'L'){
                          $horario::updateOrCreate([
                            'dia'=> 'L',
                            'idtipounidad'=> $request->get('idtipounidad'),
                           'hini'=> $request->get('editIL'),
                           'hfin'=>$request->get('editFL'),
                           'active'=>$request->get('active'),
                           'remove'=>0,
                           'idusuario'=>$request->get('idusuario'), 
                           'unidades_id' => $unidad->id  
                          ]);
                       

                          
                        }
                        if($horario->dia == 'M' ){
                            $horario::updateOrCreate([
                              'dia'=> 'M',
                              'idtipounidad'=> $request->get('idtipounidad'),
                             'hini'=> $request->get('editIM'),
                             'hfin'=>$request->get('editFM'),
                             'active'=>$request->get('active'),
                             'remove'=>0,
                             'idusuario'=>$request->get('idusuario'), 
                             'unidades_id' => $unidad->id  
                            ]);
                            $horario->save();
                            
                          }
                          if($horario->dia == 'X' ){
                            $horario::updateOrCreate([
                              'dia'=> 'X',
                              'idtipounidad'=> $request->get('idtipounidad'),
                             'hini'=> $request->get('editIX'),
                             'hfin'=>$request->get('editFX'),
                             'active'=>$request->get('active'),
                             'remove'=>0,
                             'idusuario'=>$request->get('idusuario'), 
                             'unidades_id' => $unidad->id  
                            ]);
                            $horario->save(); 
                          }
                          if($horario->dia == 'J' ){
                            $horario::updateOrCreate([
                              'dia'=> 'J',
                              'idtipounidad'=> $request->get('idtipounidad'),
                             'hini'=> $request->get('editIJ'),
                             'hfin'=>$request->get('editFJ'),
                             'active'=>$request->get('active'),
                             'remove'=>0,
                             'idusuario'=>$request->get('idusuario'), 
                             'unidades_id' => $unidad->id  
                            ]);
                            $horario->save();
                            
                          }
                          if($horario->dia == 'V' ){
                            $horario::updateOrCreate([
                              'dia'=> 'V',
                              'idtipounidad'=> $request->get('idtipounidad'),
                             'hini'=> $request->get('editIV'),
                             'hfin'=>$request->get('editFV'),
                             'active'=>$request->get('active'),
                             'remove'=>0,
                             'idusuario'=>$request->get('idusuario'), 
                             'unidades_id' => $unidad->id  
                            ]);
                            $horario->save();
                            
                          }
                          if($horario->dia == 'S' ){
                            $horario::updateOrCreate([
                              'dia'=> 'S',
                              'idtipounidad'=> $request->get('idtipounidad'),
                             'hini'=> $request->get('editIS'),
                             'hfin'=>$request->get('editFS'),
                             'active'=>$request->get('active'),
                             'remove'=>0,
                             'idusuario'=>$request->get('idusuario'), 
                             'unidades_id' => $unidad->id  
                            ]);
                            $horario->save();
                            
                          }
                          if($horario->dia == 'D' ){
                            $horario::updateOrCreate([
                              'dia'=> 'D',
                              'idtipounidad'=> $request->get('idtipounidad'),
                             'hini'=> $request->get('editID'),
                             'hfin'=>$request->get('editFD'),
                             'active'=>$request->get('active'),
                             'remove'=>0,
                             'idusuario'=>$request->get('idusuario'), 
                             'unidades_id' => $unidad->id  
                            ]);
                            $horario->save();
                            
                          }
                    }
          
            
             if ($unidad) {
                return response()->json(['success'=>'true', 200, 'correcto' => 'Editado Correctamente', 200]);
            }
            else
             {
                return response()->json(['success'=>'false','error'=>'Error no se Puedo Editar la Unidad/Equipo']);  
            }
           
        }
        
        
         
         
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $unidad = EquiposYUnidades::find($id)->delete();

        if($unidad == null){
            return response()->json(['success'=>'false','error'=>'Error no se Puedo Eliminar la Unidad/Equipo']); 
        }else{
            return response()->json(['success'=>'true', 200, 'correcto' => 'Unidad Eliminada Correctamente', 200]);
        }
    }  
}
