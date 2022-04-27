<?php

namespace App\Http\Controllers\ResourceControllers\Auxiliares;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\EstadoCivil;
use App\Http\Controllers\Controller;

class EstadoCivilController extends Controller
{
    //
    public function index ()
    {
        $estadosciviles = EstadoCivil::orderBy('nombre')->paginate(15);
        return view ('pages.estadosciviles.index', compact('estadosciviles'));
    }


    public function store(Request $request)
    {
        //dd($request);
        $estado = EstadoCivil::create($request->all());
        /*$estado = Circunscripcion::create(
            ['nombre' => 'Prueba circunscripcion']
        );*/

        return redirect()->route('estadosciviles.index')->with('success', 'Estado Civil '. $estado->nombre . ' creado correctamente con ID '. $estado->id . '.');
    }

    public function create()
    {
        // load the create form (app/views/sharks/create.blade.php)
        return view('pages.estadosciviles.create');
    }

    public function show($estadocivil)
    {
        //$estado = Circunscripcion::find($id);
        //dd($circunscripcion);
        return view ('pages.estadosciviles.show', compact('estadocivil'));
    }

    public function edit($estadocivil)
    {
        //$circunscripcion = Circunscripcion::find($id);

        return view ('pages.estadosciviles.edit', compact('estadocivil'));
    }

    public function update(Request $request, EstadoCivil $estadocivil)
    {
        //$circunscripcion = Circunscripcion::find($id);
        $estadocivil->update($request->all());

        return redirect()->route('estadosciviles.index')
            ->with('success', 'Estado Civil '. $estadocivil->nombre . ' actualizado correctamente.');
    }

    public function destroy(EstadoCivil $estadocivil)
    {
        //$estado = EstadoCivil::find($id);
        $estadocivil->delete();

        return redirect()->route('estadosciviles.index')
            ->with('success', 'Estado Civil '.  $estadocivil->nombre . ' borrado correctamente');
    }
}
