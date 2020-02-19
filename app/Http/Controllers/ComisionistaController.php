<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use tipoComisionista;

class ComisionistaController extends Controller
{
    public function tipoComisionista(Request $request)
    {
        return view('sections.commission-agents');
    }
    public function crear (Request $request)
    {
        dd($request);
    }
}
