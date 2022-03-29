<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Diputado;

class DiputadoController extends Controller
{
    //
    public function index ()
    {
        $diputados = Diputado::all();
        return view ('pages.diputados.index', compact('diputados'));
    }

    public function detalle ($id)
    {
        $diputado = Diputado::find($id);
        return view ('pages.diputados.detalle', compact('diputado'));
    }
}
