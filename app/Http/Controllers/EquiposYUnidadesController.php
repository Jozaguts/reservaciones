<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
                ]);

            // agregamos dia por dia
            }else{
                // dd($request->input('ilunes'));
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
                        'idusuario'=>$request->input('idusuario'),
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
                        'idusuario'=>$request->input('idusuario'),
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
                         'idusuario'=>$request->input('idusuario'),
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
                        'idusuario'=>$request->input('idusuario'),
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
                         'idusuario'=>$request->input('idusuario'),
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
                    ]);
                }


                
            }

         
            


             $result = EquiposYUnidades::create($request->all());
           
             if ($result) {
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
        $equipounidad = EquiposYUnidades::find($id); 
     
        return response()->json($equipounidad);
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
          $unidad = EquiposYUnidades::find($id);
         

       
            //Se realiza la validación
        $validator = Validator::make($request->all(), $rules);
        
        //si falla se redirige con los errores a la vista
        if ($validator->fails()) {
            return redirect('tipounidades')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $inputs = $request->all();

            $unidad->fill(['clave' => $request->get('clave'),
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
          
            // $tipo->fill($inputs);
            
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
