<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CongresoRepositoryInterface;

use App\Models\Congreso\Modelos\Diputado;
use App\Models\Congreso\Modelos\Partido;
use App\Models\Congreso\Modelos\Grupo;
use App\Models\Congreso\Modelos\Circunscripcion;
use App\Models\Congreso\Modelos\Sexo;
use App\Models\Congreso\Modelos\EstadoCivil;

class APIController extends Controller
{
    private CongresoRepositoryInterface $congresoRepository;

    public function __construct(CongresoRepositoryInterface $congresoRepository)
    {
        $this->congresoRepository = $congresoRepository;
    }

    public function getAllDiputados()//: JsonResponse
    {
        $data = Diputado::all();
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getDiputadoById($id)//: JsonResponse
    {
        $data = $this->congresoRepository->getDiputadoById($id);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getDiputadoByName($nombre)//: JsonResponse
    {
        $data = $this->congresoRepository->getDiputadoByName($nombre);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getAllVotacionesSummary()//: JsonResponse
    {
        $data = $this->congresoRepository->getAllVotacionesSummary();
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getVotacionesSummaryByDate($date)//: JsonResponse
    {
        $data = $this->congresoRepository->getVotacionesSummaryByDate($date);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getVotacionDetail($id)
    //: JsonResponse
    {
        $data = $this->congresoRepository->getVotacionDetail($id);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getVotacionDetailVotos($id)
    //: JsonResponse
    {
        $data = $this->congresoRepository->getVotacionDetailVotos($id);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getVotacionesSumaryByDiputadoId ($id)//: JsonResponse
    {
        $data = $this->congresoRepository->getVotacionesSumaryByDiputadoId ($id);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getAllIntervenciones()//: JsonResponse
    {
        $data = $this->congresoRepository->getAllIntervenciones();
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getIntervencionesByDate($date)//: JsonResponse
    {
        $data = $this->congresoRepository->getIntervencionesByDate($date);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getIntervencion($id)//: JsonResponse
    {
        $data = $this->congresoRepository->getIntervencion($id);
        if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getIntervencionByDiputadoId ($id)//: JsonResponse
    {
        $data = $this->congresoRepository->getIntervencionByDiputadoId($id);
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }


    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details.
            Please try again']);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);

    }

    public function getCircunscripciones ()//: JsonResponse
    {
        $data = Circunscripcion::all();
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getCircunscripcion ($id)//: JsonResponse
    {
        $data = Circunscripcion::find($id);
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getGrupos ()//: JsonResponse
    {
        $data = Grupo::all();
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getGrupo ($id)//: JsonResponse
    {
        $data = Grupo::find($id);
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getPartidos ()//: JsonResponse
    {
        $data = Partido::all();
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getPartido ($id)//: JsonResponse
    {
        $data = Partido::find($id);
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getSexos ()//: JsonResponse
    {
        $data = Sexo::all();
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getSexo ($id)//: JsonResponse
    {
        $data = Sexo::find($id);
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getEstdosCiviles ()//: JsonResponse
    {
        $data = EstadoCivil::all();
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

    public function getEstadoCivil ($id)//: JsonResponse
    {
        $data = EstadoCivil::find($id);
            if ($data != null)
            return response()->json(['data' => $data ]);
        else
            return response()->json(['message' => 'Not Found!'], 404);
    }

}
