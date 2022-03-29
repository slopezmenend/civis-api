<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Congreso\Modelos\DiputadoImportado;
use App\Models\Congreso\Modelos\Diputado;
use App\Interfaces\CongresoRepositoryInterface;

use App\Models\Congreso\Modelos\Circunscripcion;
use App\Models\Congreso\Modelos\Partido;
use App\Models\Congreso\Modelos\Grupo;

use App\Utils\DateFormater;
use App\Models\Congreso\Modelos\Votacion;
use App\Models\Congreso\Modelos\Voto;

/*use App\Interfaces\CongresoRepositoryInterface;
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
use App\Models\Status;*/

class ImportarVotacionesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private CongresoRepositoryInterface $congresoRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CongresoRepositoryInterface $congresoRepository)
    {
        $this->congresoRepository = $congresoRepository;
    }

    private function import_json_votes($url, $name)
    {
        $jsondata = file_get_contents($url);
        $data = json_decode($jsondata, true);

        $sesion = $data['informacion']['sesion'];
        $numeroVotacion = $data['informacion']['numeroVotacion'];
        $fecha = $data['informacion']['fecha'];
        $titulo = $data['informacion']['titulo'];
        $textoExpediente = $data['informacion']['textoExpediente'];
        $sesion = $data['informacion']['sesion'];
        $asentimiento = $data['totales']['asentimiento'];
        $presentes = $data['totales']['presentes'];
        $afavor = $data['totales']['afavor'];
        $enContra = $data['totales']['enContra'];
        $abstenciones = $data['totales']['abstenciones'];
        $noVotan = $data['totales']['noVotan'];

        $votacion_b = Votacion::where('sesion', $sesion)->where('numeroVotacion', $numeroVotacion)->first();

        if ($votacion_b == null)
        {
        $fecha = DateFormater::convertir_json2sql_date ($data['informacion']['fecha']);

        //creamos votacion
        $votacion = Votacion::create (
            [
                'sesion'  => $sesion,
                'numeroVotacion'  => $numeroVotacion,
                'fecha'  => $fecha,
                'titulo'  => $titulo,
                'textoExpediente'  => $textoExpediente,
                'asentimiento'  => $asentimiento,
                'presentes'  => $presentes,
                'afavor'  => $afavor,
                'enContra'  => $enContra,
                'abstenciones'  => $abstenciones,
                'noVotan'  => $noVotan
            ]
            );


        //echo "<li>".$fecha."Cargada sesion ".$sesion. " votación ".$numeroVotacion."</li>";
        $votacion->save();
        //dump ($votacion);

        //cargamos votos
        foreach ($data['votaciones'] as $votojson)
        {
            /*
            $diputado = $this->congresoRepository->getDiputadoByName($votojson['diputado']);
            if (!isset($diputado->id))
            {
                $nombre = explode('(',  $votojson['diputado']);
                $diputado = Diputado::create (
                    [
                    'nombrecompleto' => $nombre[0]
                    ]);
                //dump ($votojson);
                //dd ($diputado);
            }
            $diputado_id = $diputado->id;*/
            $diputado_id = Diputado::findOrCreate ($votojson['diputado'])->id;

            $voto = $votojson['voto'];
            //$diputado_id = $this->congresoRepository->getDiputadoByName($votojson['diputado']);
            //quitar cuando carguemos los diputados
            //$diputado_id = 1;
            $voto = Voto::create (
                [
                    'votacion_id' => $votacion->id,
                    'voto' => $voto,
                    'diputado_id' => $diputado_id
                ]);

            //dump ($voto);
            $voto->save();
        }
    }
    }

    private function get_date_votes ($date)
    {
        $path = 'https://www.congreso.es/opendata/votaciones?p_p_id=votaciones&p_p_lifecycle=0&p_p_state=normal&p_p_mode=view&targetLegislatura=XIV&targetDate=' . $date;
        $html = file_get_contents($path);

        $code = $html;
        $buscar = true;

        while ($buscar)
        {
            $start = strpos($code, 'Leg14/Sesion');
            $end = strpos($code, '.json');
            if ($end)
            {
                $start = $end - 87;
                $src = substr($code, $start, $end + 5 - $start);
                $nombre = substr ($src, strlen($src) - 23, 18);
                if (!strpos($nombre, 'response'))
                {
                    $url = "https://www.congreso.es". $src;
                    //echo "Encontrado el fichero: " . $url . " nombre: ". $nombre;
                    $this->import_json_votes ($url, $nombre);
                }
                $code = substr ($code, $end + 1, strlen($code) - $end);
            }
            else
                $buscar = !$buscar;
        }
    }

    public function importar_votaciones()
    {
        ini_set('max_execution_time', 0);
        //la fecha inicial será la misma de la última votación cargada
        //así realizaremos cargas incrementales

        $fecha = $this->congresoRepository->getFechaUltimaVotacion();

        //echo $fecha;
        if (($fecha == null) || ($fecha == '00/00/0000'))
        {
            $date = new \DateTime();
            $date->setDate(2019, 12, 3);
        }
        else
        {
            $date = DateFormater::convertir_string2date ($fecha);
        }
        //$date = $fecha;
        //dump ($date);

        $enddate = new \DateTime();
        $enddate->setDate(2022, 3, 26);
        //$enddate = date_create()->format('Y-m-d');
        //dump ($enddate);

        //$i = 0;
        //echo "<ol>";
        dump($date);
        dump($enddate);

        $contador = 0;
        $total = date_diff($enddate, $date)->d;

        dump ($total);
        while ($enddate >= $date)
        {
            $contador = $contador + 1;
            if ($contador % 10 == 0)
            {
                $avance = ($contador / $total);
                dump ($avance);
                $this->congresoRepository->setImportarVotacionesPerc($avance);
            }
            $filedate = $date->format('d/m/Y');
            $this->get_date_votes ($filedate);
            $date = $date->add (new \DateInterval('P1D'));
            //dump($date);
            //dump($enddate >= $date);
        }
        //echo "</ol>";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->congresoRepository->setImportarVotaciones(true);
        $this->importar_votaciones ();
        $this->congresoRepository->setImportarVotaciones(false);
    }
}
