<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoActividades;
use App\TipoUnidad;
use Validator;


class TipoActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoactividades = TipoActividades::all();
        $tipounidades = TipoUnidad::all();   
       return view('sections.activities.tipoactividades',compact(['tipoactividades','tipounidades' ]));
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
            'clave' => ['required', 'string', 'max:5','unique:tipoactividades'],
            'nombre' => ['required', 'string', 'max:255'],
            'color'=> ['required', 'string'],
            'usuarios_id'=> ['required', 'integer'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
            'tipounidad_id'=>['required','integer']
        ];
        
        
   

        if($request->ajax())
        {
             //Se realiza la validación
            $validator = Validator::make($request->all(), $rules);
            // $result = TipoActividades::create($request->all());
            if ($validator->fails()) 
            {
                return response()->json(['error'=> 'true','errors'=>$validator->errors()->all()]); 
            }
            else
             {
                $result = TipoActividades::create($request->all());
                return response()->json([ 'ok' => 'Actividad Agregada Correctamente', 200]);
                
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
        $tipoactividades = TipoActividades::find($id); 
     
        return response()->json($tipoactividades);
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
        $tipoactividad = TipoActividades::find($id);
        //reglas de validacion
         $rules =[
            'clave' => [ 'string', 'max:5 min:5','unique:tipoactividades'],
            'nombre' => [ 'string', 'max:255'],
            'color'=> [ 'string'],
            'usuarios_id'=> ['integer'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
            'tipounidad_id'=>['integer']
        ];
    
       
        if($request['clave'] == $tipoactividad->clave ){
            unset($request['clave']);
        }
        else{
                
                $request['clave'] =  $request['clave'];
            }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return response()->json(['success'=>'false','error'=>$validator->errors()->all()]);
        }
        else{
            dd($request->all());
            $tipoactividad::updateOrCreate($request->all()
            );
            return response()->json(['success'=>'true', 200, 'correcto' => 'Editado Correctamente', 200]);
        }
           
  
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
}
