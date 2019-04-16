<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\TipoActividades;
use Illuminate\Http\Request;
use App\TipoUnidad;
use App\Anticipos;
use App\Personas;
use Validator;

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
        $anticipos = Anticipos::all();
        $actividades = Actividades::all();
        $tipoactividades = TipoActividades::all();
        return view('sections.activities.activities', compact('actividades','tipoactividades','tipounidades','anticipos','personas'));
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

        
        // precio //no va en general
        // balance //no va en general          
        // promocion //no va en genelar
        // combo //no va en genelar
        // observaciones//no va en genelar
        // requisitos //no va en genelar
        // riesgo //no va en genelar   
        // puntos //no va en genelar
             
		
        // tipounidades_id //pendiente
      
        // anticipo_id ;//no va en general
       
       
                     //reglas de validacion
             $rules =[
                'clave' => ['required', 'string', 'max:4','unique:actividades'],
                'nombre' => ['required', 'string', 'max:255'],
                'tipoactividades_id'=> ['required', 'integer'],
                'fijo'=> ['nullable', 'boolean'],
                'renta' => ['nullable','boolean'],
                'active'=> ['nullable', 'boolean'],
                'remove' => ['nullable','boolean'],
                'minutosincluidos' => ['nullable','integer'],
                'minincremento'=>['nullable','integer'],
                'incremento'=>['nullable','integer'],
                'montoincremento'=>['nullable','between:0,99.99'],
                'maxcortesias'=>['nullable','integer'],
                'maxcupones'=>['nullable','integer'],
                'anticipo'=>['nullable','integer'],
                'idusuario'=> ['integer','required'],
                'tipounidades_id'=>['integer', 'required']
               
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

                   
                $actividad = Actividades::create([
                    'clave' => $request->get('clave'),
                    'nombre' => $request->get('nombre'),
                    'tipoactividades_id'=> $request->get('tipoactividades_id'),
                    'fijo'=> $request->get('fijo'),
                    'renta' => $request->get('renta'),
                    'active'=> $request->get('active'),
                    'remove' => $request->get('remove'),
                    'minutosincluidos' => $request->get('minutosincluidos'),
                    'minutoincrementa'=>$request->get('minutoincrementa'),
                    'incremento'=>$request->get('incremento'),
                    'montoincremento'=>$request->get('montoincremento'),
                    'maxcortesias'=>$request->get('maxcortesias'),
                    'maxcupones'=>$request->get('maxcupones'),
                    'anticipo_id'=>$request->get('anticipo_id'),
                    'idusuario'=> $request->get('idusuario'),
                    'precio' => 1.00,
                    'balance' => 10.00,
                    'promocion' => 0,
                    'combo' => 0,
                    'observaciones' => 'Observacion por Default', 
                    'requisitos' => 'Requisitos por default',
                    'riesgo' => 'Riesgos por Default',
                    'puntos' => 1,
                    'tipounidades_id' => $tipoActividad->tipoUnidad->id, 
                     
                 ]);
               
                 return response()->json([ 'ok' => 'Actividad Agregada Correctamente', 200]);
              


          
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
    public function edit(Actividades $actividades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividades $actividades)
    {
        //
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
}
