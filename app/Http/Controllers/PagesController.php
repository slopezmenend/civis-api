<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CongresoRepositoryInterface;
use App\Models\Congreso\Modelos\Partido;
use App\Models\Congreso\Modelos\Diputado;
use App\Models\Congreso\Modelos\DiputadoImportado;
use App\Models\Congreso\Modelos\Grupo;
use App\Models\Congreso\Modelos\Circunscripcion;

class PagesController extends Controller
{
    private CongresoRepositoryInterface $congresoRepository;

    public function __construct(CongresoRepositoryInterface $congresoRepository)
    {
        $this->congresoRepository = $congresoRepository;
    }

    //Página de inicio
    public function index ()
    {
        $summary = $this->congresoRepository->getSummaryData ();
        return view ('pages.index', compact ('summary'));
    }


        //dd($summary);

    //}
/*
    public function diputado_edit($id)
    {
        $diputado = Diputado::find($id);// $this->congresoRepository->getDiputadoById($id);
        $partidos = Partido::all();
        $circunscripciones = Circunscripcion::all();
        $grupos = Grupo::all();
        $sexos = Sexo::all();
        $estadosciviles = EstadoCivil::all();
        return view ('pages.diputados.editar', compact('diputado', 'partidos', 'circunscripciones', 'grupos', 'sexos', 'estadosciviles'));
    }

    public function diputado_update(Request $request, $id)
    {
        $diputado = Diputado::find($id); //$this->congresoRepository->getDiputadoById($id);
        /*$output = $diputado;
        if (is_array($output))
            $output = implode(',', $output);
        echo "<script>console.log('Debug Objects: " . $output . "' ); setTimeout('', 5000);</script>";

        $request->validate([
            'nombrecompleto' => 'required'
        ]);

        $diputado->nombre = $request->nombre;
        $diputado->apellidos = $request->apellidos;
        /*circunscripcion_id = circunscripcion;
        partido_id = partido;
        fechacondicion = fechacondicion;
        fechaalta = fechaalta;
        grupo_id = grupo;
        biografia = biografia;
        $diputado->save();

        return redirect('/diputados')->with('success', 'Diputado actualizado correctamente');
    }

    public function diputado_destroy($id)
    {
        $diputado = $this->congresoRepository->getDiputadoById($id);
        $diputado->delete();

        return redirect()->route('pages.diputados.index')
            ->with('success', 'Diputado borrado correctamente');
    }

    public function votacion_index()
    {
        $votaciones = $this->congresoRepository->getAllVotacionesSummary();
        return view ('pages.votaciones.index', compact('votaciones'));
    }

    public function getVotacionesSummaryByDate($date)
    {
        $data = $this->congresoRepository->getVotacionesSummaryByDate($date);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function votacion_show($id)

    {
        $votacion = $this->congresoRepository->getVotacionDetail($id);
        return view ('pages.votaciones.detalle', compact('votacion'));
    }

    public function voto_index($id)

    {
        $votos = $this->congresoRepository->getVotacionDetailVotos($id);
        foreach ($votos as $voto)
            $votacion = $voto->votacion_id;
        return view ('pages.votaciones.votos', compact('votos', 'votacion'));
    }

    public function getVotacionesSumaryByDiputadoId ($id)
    {
        $data = $this->congresoRepository->getVotacionesSumaryByDiputadoId ($id);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getAllIntervenciones()
    {
        $data = $this->congresoRepository->getAllIntervenciones();
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getIntervencionesByDate($date)
    {
        $data = $this->congresoRepository->getIntervencionesByDate($date);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getIntervencion($id)
    {
        $data = $this->congresoRepository->getIntervencion($id);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getIntervencionByDiputadoId ($id)
    {
        $data = $this->congresoRepository->getIntervencionByDiputadoId($id);
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }*/
    /*public function importar_diputados ()
    {
        return view ('pages.diputados.importar');
    }

    public function diputados ()
    {
        $title = 'About us';
        return view ('pages.about', compact('title'));
    }    */

    public function login() {
        return view ('pages.login');
    }

    public function signup() {
        return view ('pages.signup.index');
    }

    public function signupConfirmation(Request $request) {
        //dump ($request);
        return view ('pages.signup.confirm');
    }
}
