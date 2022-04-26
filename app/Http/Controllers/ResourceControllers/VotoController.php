<?php

namespace App\Http\Controllers\ResourceControllers;

use Illuminate\Http\Request;
use App\Models\Congreso\Modelos\Voto;
use App\Http\Controllers\Controller;

class VotoController extends Controller
{
    //
    public function index ($id)
    {
        //dump($id);
        $votos = Voto::where('votacion_id', $id)->whereNotNull('diputado_id')->orderBy('votacion_id', 'asc')->orderBy('diputado_id', 'asc')->paginate(15);
        //dd($votos);
        foreach ($votos as $voto)
            $votacion = $voto->votacion_id;
        return view ('pages.votos.index', compact('votos', 'votacion'));
    }

    public function store(Request $request)
    {
    }

    public function show(Voto $voto)
    {
    }

    public function edit(Voto $voto)
    {
    }

    public function update(Request $request, Voto $voto)
    {
    }

    public function destroy(Voto $voto)
    {
    }

}
