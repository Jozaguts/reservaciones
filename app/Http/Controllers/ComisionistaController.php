<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoComisionista;
use Illuminate\Http\Request;
use App\TipoComisionista;

class ComisionistaController extends Controller
{
    public function tipoComisionista(Request $request)
    {
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
                    return response()->json(['response' => '¡Tipo de comisionista creado exitosamente!']);
                } else {
                    return response()->json(['response' => '¡Error al crear nuevo tipo de comisionista!']);
                }
            } catch (Exception $e) {
                return response()->json(['response' => $e->getMessage()]);
            }
        }
    }
}
