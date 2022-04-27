<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CongresoRepositoryInterface;
use App\Models\Congreso\Modelos\Partido;
use App\Models\Congreso\Modelos\Diputado;
use App\Models\Congreso\Modelos\DiputadoImportado;
use App\Models\Congreso\Modelos\Grupo;
use App\Models\Congreso\Modelos\Circunscripcion;
use Illuminate\Support\Facades\Auth;

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

        if (!Auth::guest())
        {
            $summary = $this->congresoRepository->getSummaryData ();
            return view ('pages.index', compact ('summary'));
        }
        else{
            return view ('pages.welcome');
        }
    }

}
