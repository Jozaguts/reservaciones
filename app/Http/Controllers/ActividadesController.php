<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\TipoActividades;
use Illuminate\Http\Request;
use App\TipoUnidad;
use App\Anticipos;
use App\Personas;
use Validator;
use App\ActividadPrecios;


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
       
                     //reglas de validacion
             $rules =[
                'clave' => ['required', 'string', 'min:5','unique:actividades'],
                'nombre' => ['required', 'string', 'max:255'],
                'tipoactividades_id'=> ['required', 'integer'],
                'fijo'=> ['nullable', 'boolean'],
                'renta' => ['nullable','boolean'],
                'active'=> ['nullable', 'boolean'],
                'remove' => ['nullable','boolean'],
                'minutosincluidos' => ['nullable','integer'],
                'minutoincrementa'=>['nullable','integer'],
                'montoincremento'=>['nullable','between:0,999999.99'],
                'maxcortesias'=>['nullable','integer'],
                'maxcupones'=>['nullable','integer'],
                'anticipo_id'=>['required','integer'],
                'idusuario'=> ['integer','required'],
                'tipounidades_id'=>['integer', 'required'],
                'precio' =>['required','between:0,999999.99'],
                'balance' =>['required','between:0,999999.99'],
                'promocion'=>['boolean','nullable'],
                'combo' =>['boolean','nullable'],
                'observaciones' =>['nullable','string'], 
                'requisitos' =>['nullable','string'],
                'riesgo' =>['nullable','string','max:45'],
                'puntos' =>['nullable','integer'],
               
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
                    'montoincremento'=>$request->get('montoincremento'),
                    'maxcortesias'=>$request->get('maxcortesias'),
                    'maxcupones'=>$request->get('maxcupones'),
                    'anticipo_id'=>$request->get('anticipo_id'),
                    'idusuario'=> $request->get('idusuario'),
                    'tipounidades_id' => $tipoActividad->tipoUnidad->id, 
                    'precio' => $request->get('precio'),
                    'balance' => $request->get('balance'),
                    'promocion' => 0,
                    'combo' => 0,
                    'observaciones' => 'Observacion por Default', 
                    'requisitos' => 'Requisitos por default',
                    'riesgo' => 'Riesgos por Default',
                    'puntos' => 1,
                    
                     
                 ]);
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
                        ['actividades_id' => $actividad->id, 'persona_id' => $datoPersona['persona_id']  ], 
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
                   
                 }
               
           
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
