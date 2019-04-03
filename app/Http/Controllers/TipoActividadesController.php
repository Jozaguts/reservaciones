<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoActividades;
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
           
       return view('sections.activities.tipoactividades',compact('tipoactividades'));
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
            'clave' => ['required', 'string', 'max:5 min:5','unique:tipoactividades'],
            'nombre' => ['required', 'string', 'max:255'],
            'color'=> ['required', 'string'],
            'usuarios_id'=> ['required', 'integer'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
        ];
         //Se realiza la validación
         $validator = Validator::make($request->all(), $rules);
   

        if($request->ajax())
        {
            // $result = TipoActividades::create($request->all());
            if ($validator->fails()) 
            {
                return response()->json(['success'=>'false','error'=>$validator->errors()->all()]); 
            }
            else
             {
                $result = TipoActividades::create($request->all());
                return response()->json(['success'=>'true', 200, 'correcto' => 'Actividad Agregada Correctamente', 200]);
                
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
}
