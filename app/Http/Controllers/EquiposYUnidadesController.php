<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquiposYUnidades;
use Validator;

class EquiposYUnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = EquiposYUnidades::all();
        return view('sections.activities.equiposyunidades', compact('unidades'));
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
            'clave' => ['required', 'string', 'max:255'],
            'placa' => ['required', 'string', 'max:255'],
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
         if ($validator->fails()) {
            return redirect('unidades')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->ajax())
        {
            $result = EquiposYUnidades::create($request->all());
            if ($result) {
                return response()->json(['success'=>'true', 200, 'correcto' => 'Agregado Correctamente', 200]);
            }
            else
             {
                return response()->json(['success'=>'false','error'=>'Error no se Puedo Agregar la Unidad/Equipo']);  
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
