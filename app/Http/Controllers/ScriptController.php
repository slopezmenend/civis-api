<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CongresoRepositoryInterface;
use DateTime;
use DateInterval;
use App\Models\Congreso\Modelos\Intervencion;
use App\Models\Congreso\Modelos\Votacion;
use App\Models\Congreso\Modelos\Voto;
use App\Models\Congreso\Modelos\DiputadoImportado;
use App\Models\Congreso\Modelos\Diputado;
use App\Models\Congreso\Modelos\Circunscripcion;
use App\Models\Congreso\Modelos\Partido;
use App\Models\Congreso\Modelos\Grupo;
use App\Scripts\ImportadorVotaciones;

use App\Jobs\ImportarDiputadosJob;
use App\Jobs\ImportarVotacionesJob;
use App\Jobs\ImportarIntervencionesJob;

use Illuminate\Console\Scheduling\Schedule;

function convertir_json2sql_date ($date)
{
    $trozos = explode('/', $date);
    $fecha_temp = $trozos[2] . "-" . $trozos[1] . "-" . $trozos[0];
    return $fecha_temp;
}

class ScriptController extends Controller
{
    public function import_diputados_job ()
    {
        ImportarDiputadosJob::dispatch();
        return redirect('/')->with('success', 'Proceso de importado de diputados lanzado correctamente');
    }

    public function import_votaciones_job ()
    {
        ImportarVotacionesJob::dispatch();
        return redirect('/')->with('success', 'Proceso de importado de votaciones lanzado correctamente');
    }

    public function import_intervenciones_job ()
    {
        ImportarIntervencionesJob::dispatch();
        return redirect('/')->with('success', 'Proceso de importado de intervenciones lanzado correctamente');
    }
}
?>
