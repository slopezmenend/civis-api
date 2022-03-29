<?php

namespace App\Http\Controllers\ResourceControllers;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Votacion;
use App\Http\Controllers\Controller;

class VotacionController extends Controller
{
    //
    public function index ()
    {
        $votaciones = Votacion::orderBy('sesion', 'asc')->orderBy('numeroVotacion', 'asc')->paginate(15);
        return view ('pages.votaciones.index', compact('votaciones'));
    }


    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $votacion = Votacion::find($id);
        return view ('pages.votaciones.show', compact('votacion'));
    }

    public function edit(Votacion $votacion)
    {
    }

    public function update(Request $request, Votacion $votacion)
    {
    }

    public function destroy(Votacion $votacion)
    {
    }

}
