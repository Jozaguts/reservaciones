<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquiposYUnidades;
use Validator;
use App\TipoUnidad;

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
        
        return view('sections.activities.equiposyunidades', compact('unidades','tipounidades'));
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
            'clave' => ['required', 'string', 'min:5', 'max:5'],
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
             $result = EquiposYUnidades::create($request->all());
             if ($result) {
                 return response()->json(['success'=>'true', 200, 'correcto' => 'Agregado Correctamente', 200]);
             }
            //  else
            //   {
            //      return response()->json(['success'=>'false','error'=>'Error no se Puedo Agregar la Unidad/Equipo']);  
            //  }
         }

         
        //  if ($validator->fails()) {
        //     return redirect('unidades')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }

   
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
            'clave' => [ 'string', 'max:255'],
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
