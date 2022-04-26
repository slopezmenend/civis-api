<?php

namespace App\Http\Controllers\ResourceControllers\Auxiliares;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Circunscripcion;
use App\Http\Controllers\Controller;

class CircunscripcionController extends Controller
{
    //
    public function index ()
    {
        $circunscripciones = Circunscripcion::orderBy('nombre')->paginate(15);
        return view ('pages.circunscripciones.index', compact('circunscripciones'));
    }


    public function store(Request $request)
    {
        //dd($request);
        $circunscripcion = Circunscripcion::create($request->all());
        /*$circunscripcion = Circunscripcion::create(
            ['nombre' => 'Prueba circunscripcion']
        );*/

        return redirect()->route('circunscripciones.index')->with('success', 'Circunscripcion '. $circunscripcion->nombre . ' creado correctamente con ID '. $circunscripcion->id . '.');
    }

    public function create()
    {
        // load the create form (app/views/sharks/create.blade.php)
        return view('pages.circunscripciones.create');
    }

    public function show($id)
    {
        $circunscripcion = Circunscripcion::find($id);
        //dd($circunscripcion);
        return view ('pages.circunscripciones.show', compact('circunscripcion'));
    }

    public function edit($id)
    {
        $circunscripcion = Circunscripcion::find($id);

        return view ('pages.circunscripciones.edit', compact('circunscripcion'));
    }

    public function update(Request $request, $id)
    {
        $circunscripcion = Circunscripcion::find($id);
        $circunscripcion->update($request->all());

        return redirect()->route('circunscripciones.index')
            ->with('success', 'circunscripcion '. $circunscripcion->nombre . ' actualizado correctamente.');
    }

    public function destroy($id)
    {
        $circunscripcion = Circunscripcion::find($id);
        $circunscripcion->delete();

        return redirect()->route('circunscripciones.index')
            ->with('success', 'Circunscripcion '.  $circunscripcion->nombre . ' borrado correctamente');
    }
}
