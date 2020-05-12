<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoComisionista;
use Illuminate\Http\Request;
use App\TipoComisionista;
use Illuminate\Support\Facades\DB;


class ComisionistaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tipoComisionistas = TipoComisionista::where('deleted_at', null)->get();
            return response()->json(['tipoComisionistas' => $tipoComisionistas]);
        }
        return view('sections.commission-agents');
    }

    public function crear(StoreTipoComisionista $request)
    {
        if ($request->ajax()) {
            $tipoComisionista = new TipoComisionista();
            try {
                $tipoComisionista->fill([
                    'nombre' => $request->nombre,
                    'clave' => $request->clave,
                    'idusuario' => $request->user()->id,
                ]);
                if ($tipoComisionista->save()) {
                    $tipoComisionistas = TipoComisionista::all();
                    return response()->json(['response' => '¡Tipo de comisionista creado exitosamente!', 'tipoComisionistas' => $tipoComisionistas]);
                } else {
                    return response()->json(['response' => '¡Error al crear nuevo tipo de comisionista!']);
                }
            } catch (Exception $e) {
                return response()->json(['response' => $e->getMessage()]);
            }
        }
    }

    public function getComisionistas(Request $request)
    {

        if ($request->ajax()) {

            $comisionistas = DB::table('comisionistas')
                ->select('id', 'nombre')
                ->where('active', '=', '1')
                ->get();

            return response()->json(['comisionistas' => $comisionistas]);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $data = $request->all()['tipoComisionistas'];
            TipoComisionista::where('id', $id)
                ->update($data);
            $tipoComisionistas = TipoComisionista::all();
            return response()->json(['success' => 'Tipo comisionista actualizado', 'tipoComisionista' => $tipoComisionistas], 200);
        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
    public function delete ($id) 
    {
        
        try {
            $tipoComisionista = TipoComisionista::find($id);
            $tipoComisionista->delete();
            return response()->json(['success' =>"Tipo comisionista Eliminado {$tipoComisionista->nombre}"],200); 
        } catch (\Throwable $th) {
            return response()->json(['Errors' => $th->getMessage(), 400]); 
            
        }
    }
}
