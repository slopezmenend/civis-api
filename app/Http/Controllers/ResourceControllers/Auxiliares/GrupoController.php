<?php

namespace App\Http\Controllers\ResourceControllers\Auxiliares;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Grupo;
use App\Http\Controllers\Controller;

class GrupoController extends Controller
{
    //
    public function index ()
    {
        $grupos = Grupo::orderBy('nombre')->paginate(15);
        return view ('pages.grupos.index', compact('grupos'));
    }


    public function store(Request $request)
    {
        //dd($request);
        $grupo = Grupo::create($request->all());

        return redirect()->route('grupos.index')->with('success', 'Grupo '. $grupo->nombre . ' creado correctamente con ID '. $grupo->id . '.');
    }

    public function create()
    {
        // load the create form (app/views/sharks/create.blade.php)
        return view('pages.grupos.create');
    }

    public function show(Grupo $grupo)
    {
        return view ('pages.grupos.show', compact('grupo'));
    }

    public function edit(Grupo $grupo)
    {

        return view ('pages.grupos.edit', compact('grupo'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        //$grupo->nombre = "prueba";
        $grupo->update($request->all());

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo '. $grupo->nombre . ' actualizado correctamente.');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete($grupo);
        return redirect()->route('grupos.index')->with('success', 'Grupo '. $grupo->nombre . ' borrado correctamente');
    }
}
