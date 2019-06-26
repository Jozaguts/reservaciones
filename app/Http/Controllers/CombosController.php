<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anticipos;
use App\TipoActividades;
use Illuminate\Support\Facades\DB;
class CombosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $anticipos = Anticipos::all();
        $tipoactividades = TipoActividades::all();
         $actividades = DB::table('actividades as ac')
               ->select('ac.id', 'ac.clave', 'ac.nombre')
               ->where([['ac.active', '=','1'], ['ac.remove','=','0'], ['ac.renta','=','0']])
               ->orderBy('ac.clave')
               ->get();
            
        return view('sections.activities.combos',compact('anticipos','tipoactividades','actividades'));
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
        //
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
    public function infoactividad($id){
        
        return $id;
    }
}
