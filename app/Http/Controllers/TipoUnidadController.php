<?php

namespace App\Http\Controllers;

use App\TipoUnidad;
use Illuminate\Http\Request;
use Validator;

class TipoUnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tipounidades = TipoUnidad::all();
           
       return view('sub-sections.tipodeequipoyunidades',compact('tipounidades'));
   
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
            'nombre' => ['required', 'string', 'max:255'],
            'combustible' => ['required', 'string', 'max:255'],
            'medio'=> ['required', 'string'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
        ];
         //Se realiza la validación
         $validator = Validator::make($request->all(), $rules);

        if($request->ajax())
        {
            $result = TipoUnidad::create($request->all());
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
