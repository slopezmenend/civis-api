<?php

namespace App\Http\Controllers\ResourceControllers\Auxiliares;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Partido;
use App\Http\Controllers\Controller;

class PartidoController extends Controller
{
    //
    public function index ()
    {
        $partidos = Partido::orderBy('nombre')->paginate(15);
        return view ('pages.partidos.index', compact('partidos'));
    }


    public function store(Request $request)
    {
        //dd($request);
        $partido = Partido::create($request->all());

        return redirect()->route('pages.partidos.index')->with('success', 'Partido '. $partido->nombre . ' creado correctamente con ID '. $partido->id . '.');
    }

    public function create()
    {
        // load the create form (app/views/sharks/create.blade.php)
        return view('pages.partidos.create');
    }

    public function show(Partido $partido)
    {
        return view ('pages.partidos.show', compact('partido'));
    }

    public function edit(Partido $partido)
    {

        return view ('pages.partidos.edit', compact('partido'));
    }

    public function update(Request $request, Partido $partido)
    {
        //$partido->urllogo = "prueba";
        $partido->update($request->all());

        return redirect()->route('partidos.index')
            ->with('success', 'Partido '. $partido->nombre . ' actualizado correctamente.');
    }

    public function destroy(Partido $partido)
    {
        $partido->delete($partido);
        return redirect()->route('partidos.index')->with('success', 'partido '. $partido->nombre . ' borrado correctamente');
    }
}
