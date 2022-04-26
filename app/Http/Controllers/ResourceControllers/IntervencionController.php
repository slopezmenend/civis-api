<?php

namespace App\Http\Controllers\ResourceControllers;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Intervencion;
use App\Models\Congreso\Modelos\Diputado;
use App\Http\Controllers\Controller;

class IntervencionController extends Controller
{
    //
    public function index ()
    {
        $intervenciones = Intervencion::whereNotNull('diputado_id')->orderBy('sesion','asc')->paginate(15);
        return view ('pages.intervenciones.index', compact('intervenciones'));
    }


    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $intervencion = Intervencion::find($id);
        return view ('pages.intervenciones.show', compact('intervencion'));
    }

    public function edit($id)
    {
        $intervencion = Intervencion::find($id);
        $diputados = Diputado::all();
        return view ('pages.intervenciones.edit', compact('intervencion','diputados'));
    }

    public function update(Request $request, $id)
    {
        $intervencion = Intervencion::find($id);
        //dump($intervencion);
        //dd($request);
        //$intervencion->enlaceSubtitles = $intervencion->enlaceSubtitles . "-mod";
        $intervencion->update($request->all());

        return redirect()->route('intervenciones.index')
            ->with('success', 'Intervencion '. $intervencion->id . ' actualizada correctamente.');
    }

    public function destroy(Intervencion $intervencion)
    {

    }
}

