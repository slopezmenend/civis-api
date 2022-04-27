<?php

namespace App\Http\Controllers\ResourceControllers\Auxiliares;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Sexo;
use App\Http\Controllers\Controller;

class SexoController extends Controller
{
    //
    public function index ()
    {
        $sexos = Sexo::orderBy('nombre')->paginate(15);
        return view ('pages.sexos.index', compact('sexos'));
    }


    public function store(Request $request)
    {
        //dd($request);
        $sexo = Sexo::create($request->all());
        /*$Sexo = Sexo::create(
            ['nombre' => 'Prueba Sexo']
        );*/

        return redirect()->route('sexos.index')->with('success', 'Sexo '. $sexo->nombre . ' creado correctamente con ID '. $sexo->id . '.');
    }

    public function create()
    {
        // load the create form (app/views/sharks/create.blade.php)
        return view('pages.sexos.create');
    }

    public function show($id)
    {
        $sexo = Sexo::find($id);
        //dd($Sexo);
        return view ('pages.sexos.show', compact('sexo'));
    }

    public function edit($id)
    {
        $sexo = Sexo::find($id);

        return view ('pages.sexos.edit', compact('sexo'));
    }

    public function update(Request $request, $id)
    {
        $sexo = Sexo::find($id);
        $sexo->update($request->all());

        return redirect()->route('sexos.index')
            ->with('success', 'Sexo '. $sexo->nombre . ' actualizado correctamente.');
    }

    public function destroy($id)
    {
        $sexo = Sexo::find($id);
        $sexo->delete();

        return redirect()->route('sexos.index')
            ->with('success', 'Sexo '.  $sexo->nombre . ' borrado correctamente');
    }
}
