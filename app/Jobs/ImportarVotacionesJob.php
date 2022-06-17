<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Utils\FormaterUtils;
use App\Models\Congreso\Modelos\Votacion;
use App\Models\Congreso\Modelos\Voto;
use App\Utils\Avance;

class ImportarVotacionesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Avance $avance;

    private function import_json_votes($url, $name)
    {
        //$jsondata = file_get_contents($url);
        $jsondata = HTMLUtils::url_get_content($url);
        $data = json_decode($jsondata, true);

        //cargamos la votación
        $votacion = Votacion::createFromJSON ($data);

        //cargamos votos
        foreach ($data['votaciones'] as $votojson)
        {
            $voto = Voto::createFromJSON ($votojson, $votacion->id);
        }
    }

    private function get_date_votes ($date)
    {
        $path = 'https://www.congreso.es/opendata/votaciones?p_p_id=votaciones&p_p_lifecycle=0&p_p_state=normal&p_p_mode=view&targetLegislatura=XIV&targetDate=' . $date;
        //$html = file_get_contents($path);
        $html = HTMLUtils::url_get_content($path);

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

        $fecha = Votacion::max('fecha');

        //echo $fecha;
        if (($fecha == null) || ($fecha == '00/00/0000'))
        {
            $date = new \DateTime();
            if (\App::environment('local'))
                $date->setDate(2019, 12, 3);
            else
                $date->setDate(2022, 4, 1);
        }
        else
        {
            $date = FormaterUtils::convertir_string2date ($fecha);
        }

        $enddate = now();
        $contador = 0;
        $total = date_diff($enddate, $date)->format('%a');;
        $error = false;

        //ahora creamos el objeto de avance para mostrar el progreso
        $this->avance = new Avance ('VOTACIONES_ST', 'VOTACIONES_AV', $total);

        while (($enddate >= $date) && (!$error))
        {
            $filedate = $date->format('d/m/Y');

            //avanzamos el avance
            $this->avance->avanzar($contador = $contador + 1);

//            dump ($filedate);
            $this->get_date_votes ($filedate);
            $date = $date->add (new \DateInterval('P1D'));
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->importar_votaciones ();
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        if (isset($this->avance))
            $this->avance->finalizar();
        dump ("Proceso terminado por excepción");
    }
}
