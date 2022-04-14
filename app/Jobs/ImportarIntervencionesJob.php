<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Congreso\Modelos\Intervencion;
use App\Utils\HTMLUtils;
use App\Utils\Avance;

class ImportarIntervencionesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Avance $avance;

    public function importar_intervenciones_json($url)
    {
        //hacemos que no se boquee el job por timeout
        ini_set('max_execution_time', 0);

        //leemos las intervenciones del json indicado
        $jsondata = file_get_contents($url);
        $data = json_decode($jsondata, true);

        //ahora creamos el objeto de avance para mostrar el progreso
        $this->avance = new Avance ('INTERVENCIONES_ST', 'INTERVENCIONES_AV', sizeof($data));
        $contador = 0;

        foreach ($data as $intervencion)
        {
            // Si estamos en producción cargamos los últimos 2 meses únicamente por limitaciones de tamaño en BBDD (Heroku)
            $year = substr($intervencion['SESION'], 6 ,4);
            $month = substr ($intervencion['SESION'], 3 ,2);

            $cargar = \App::environment('local') ||
                    ($year == '2022') && (($month == '04') || ($month == '05'));

            if ($cargar) {
                //creamos la intervencion para cada registro
                $int = Intervencion::createFromJSON ($intervencion);
            }
            //avanzamos el avance
            $this->avance->avanzar($contador = $contador + 1);
        }
    }

    public function importar_intervenciones()
    {
        $ruta    = 'https://www.congreso.es/opendata/intervenciones';
        $class   = 'btn btn-primary btn-vot';
        $pattern = '*Intervenciones*.json';
        $urls = HTMLUtils::get_enlaces ($ruta, $class, $pattern);
        dump($urls);
        foreach ($urls as $url)
        {
            dump("URL: ", $url);
            $this->importar_intervenciones_json($url);
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->importar_intervenciones();
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
