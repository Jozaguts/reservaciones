<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoComisionista;
use Illuminate\Http\Request;
use App\TipoComisionista;

class ComisionistaController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
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
                    return response()->json(['response' => '¡Tipo de comisionista creado exitosamente!','tipoComisionistas' => $tipoComisionistas]);
                } else {
                    return response()->json(['response' => '¡Error al crear nuevo tipo de comisionista!']);
                }
            } catch (Exception $e) {
                return response()->json(['response' => $e->getMessage()]);
            }
        }
    }
}
