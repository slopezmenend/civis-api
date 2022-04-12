<?php

namespace App\Http\Controllers\ResourceControllers;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Diputado;
use App\Models\Congreso\Modelos\Partido;
use App\Models\Congreso\Modelos\Grupo;
use App\Models\Congreso\Modelos\Circunscripcion;
use App\Models\Congreso\Modelos\Sexo;
use App\Models\Congreso\Modelos\EstadoCivil;
use App\Http\Controllers\Controller;

class DiputadoController extends Controller
{
    //
    public function index ()
    {
        $diputados = Diputado::orderBy('nombrecompleto')->paginate(15);
        return view ('pages.diputados.index', compact('diputados'));
    }

    /*public function store(Request $request)
    {
        $request->validate([
            'nombrecompleto' => 'required'
        ]);

        Diputado::create($request->all());

        return redirect()->route('pages.diputados.index')
            ->with('success', 'Diputado '. $diputado->nombrecompleto . ' creado correctamente.');
    }*/

    public function show(Diputado $diputado)
    {
        //$diputado = Diputado::find($id);
        $diputado->sexo_id != null? $sexo = Sexo::find($diputado->sexo_id)->nombre : $sexo = '';
        $diputado->estadocivil_id != null? $estadocivil = EstadoCivil::find($diputado->estadocivil_id)->nombre : $estadocivil = '';

        return view ('pages.diputados.show', compact('diputado', 'sexo', 'estadocivil'));
    }

    public function edit(Diputado $diputado)
    {
        $partidos = Partido::all();
        $circunscripciones = Circunscripcion::all();
        $grupos = Grupo::all();
        $sexos = Sexo::all();
        $estadosciviles = EstadoCivil::all();
        return view ('pages.diputados.edit', compact('diputado', 'partidos', 'circunscripciones', 'grupos', 'sexos', 'estadosciviles'));
    }

    public function update(Request $request, Diputado $diputado)
    {
        //$diputado->nombre = $diputado->nombre . "-mod";
        //dd($request->all());
        //dd($request);
        $diputado->update($request->all());

        return redirect()->route('diputados.index')
            ->with('success', 'Diputado '. $diputado->nombrecompleto . ' actualizado correctamente.');
    }

    public function destroy(Diputado $diputado)
    {
        $diputado->delete();
        //dump ($diputado);

        return redirect()->route('diputados.index')
            ->with('success', 'Diputado '. $diputado->nombrecompleto . ' borrado correctamente');
    }
}
