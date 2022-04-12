<?php

namespace App\Http\Controllers\ResourceControllers;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Diputado;
use App\Models\Congreso\Modelos\DiputadoImportado;
use App\Models\Congreso\Modelos\Partido;
use App\Models\Congreso\Modelos\Grupo;
use App\Models\Congreso\Modelos\Circunscripcion;
use App\Models\Congreso\Modelos\Sexo;
use App\Models\Congreso\Modelos\EstadoCivil;
use App\Http\Controllers\Controller;

class DiputadoImportadoController extends Controller
{
    //

    public function index ()
    {
        //dump ("index function");
        $diputados = DiputadoImportado::where('revisado', 'false')->orderBy('nombre')->paginate(15);
        //dd ($diputados);
        //return view ('pages.index');
        return view ('pages.diputados.review.index', compact('diputados'));
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

    public function show(DiputadoImportado $diputado)
    {
        dd($diputado);
        return view ('pages.diputados.review.show', compact('diputado'));
    }

    public function edit(DiputadoImportado $diputado_imp)
    {
        $diputado = Diputado::find($id);
        //$diputado_imp = DiputadoImportado::find($id);
        $partidos = Partido::all();
        $circunscripciones = Circunscripcion::all();
        $grupos = Grupo::all();
        $sexos = Sexo::all();
        $estadosciviles = EstadoCivil::all();
        return view ('pages.diputados.review.edit', compact('diputado', 'diputado_imp', 'partidos', 'circunscripciones', 'grupos', 'sexos', 'estadosciviles'));
    }

    public function update(Request $request, DiputadoImportado $diputado_imp)
    {
        $diputado = Diputado::find($diputado_imp->id);
        $diputado->fechaimportado = $diputado_imp->updated_at;
        $diputado->fecharevision = now();
        $diputado->update($request->all());

        //$diputado_imp->update($request->all());
        $diputado_imp->revisado = true;
        $diputado_imp->save();

        return redirect()->route('diputados.review.index')
            ->with('success', 'Diputado '. $diputado->nombrecompleto . ' actualizado correctamente.');
    }
}
