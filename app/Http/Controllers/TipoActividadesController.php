<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoActividades;
use App\TipoUnidad;
use Validator;
use App\Http\Requests\TipoUnidadStore;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class TipoActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipoactividades = TipoActividades::with('TipoUnidad')->get();
        $tipounidades = TipoUnidad::all();

        if($request->ajax()){
           return  $tipoactividades;
        }

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
    public function store(TipoUnidadStore $request)
    {

        $tipo_actividad = $request->all();

        $tipo_actividad['usuarios_id'] = Auth::user()->id;

        TipoActividades::create($tipo_actividad);

        return response()->json([ 'message' => 'Tipo Actividad Agregada Correctamente']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoactividades = TipoActividades::find($id);

        return response()->json($tipoactividades);
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
        $data = $request->all();
        $data['usuarios_id'] = Auth::user()->id;
    
        $rules =[
            'clave' =>['string','min:5'],
            'nombre' => [ 'string', 'max:255'],
            'color'=> [ 'string'],
            'usuarios_id'=> ['integer'],
            'removed' => ['nullable','boolean'],
            'active' => ['nullable','boolean'],
            'tipounidad_id'=>['integer'],
        ];

       
        $validator = Validator::make($request->all(), $rules);

     

        if ($validator->fails())
        {
            return response()->json(['error'=> 'true','errors'=>$validator->errors()->all()]);
        }
        else{
        
            TipoActividades::where('id',$data['id'])
            ->update([
                'clave'=> $data['clave'],
                'nombre'=> $data['nombre'],
                'color'=> $data['color'],
                'usuarios_id'=> $data['usuarios_id'],
                'tipounidad_id'=> $data['tipounidad_id']
            ]);
           
            return response()->json([ 'message' => 'Actividad Actualizada Correctamente', 200]);
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
     
        $actividad = TipoActividades::find($id)->delete();

        if($actividad['deleted_at'] != null){
           
            return response()->json(['message' => 'Unidad Eliminada Correctamente']);
        }else{
         
            return response()->json(['message'=>'Error no se Puedo Eliminar la Actividad']);
        }
    }
}
