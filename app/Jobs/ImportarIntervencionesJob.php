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
    //private CongresoRepositoryInterface $congresoRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    /*public function __construct(CongresoRepositoryInterface $congresoRepository)
    {
        $this->congresoRepository = $congresoRepository;
    }*/

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

            //dump ("Intervencion ", $year, $month);
            //dump (\App::environment('local'));

            $cargar = \App::environment('local') ||
                    ($year == '2022') && (($month == '04') || ($month == '05'));

            if ($cargar) {
                //creamos la intervencion para cada registro
                $int = Intervencion::createFromJSON ($intervencion);
            }
            //avanzamos el avance
            $this->avance->avanzar($contador = $contador + 1);

                //dump ($contador, $int);
        }


        /*ini_set('max_execution_time', 0);
        //$url = 'https://www.congreso.es/webpublica/opendata/intervenciones/IntervencionesCronologicamente__20220318050122.json';
        $jsondata = file_get_contents($url);
        $data = json_decode($jsondata, true);

        $contador = 0;
        $total = sizeof($data);

        //cargamos diputados importados
        foreach ($data as $intervencion)
        {
            $contador = $contador + 1;
            if ($contador % 10 == 0)
            {
                $avance = ($contador / $total) * 100;
                dump ($avance);
                $this->congresoRepository->setImportarIntervencionesPerc($avance);
            }

            //dump ($intervencion);
            $legislatura = 14;
            $objeto = $intervencion['OBJETOINICIATIVA'];
            $sesion =  DateFormater::convertir_json2sql_date ($intervencion['SESION']);
            $organo = $intervencion['ORGANO'];
            if (isset($intervencion['FASE']))
            $fase = $intervencion['FASE'];
            else $fase = '';

            $tipoIntervencion = $intervencion['TIPOINTERVENCION'];
            if (isset($intervencion['CARGOORADOR']))
            $cargo = $intervencion['CARGOORADOR'];
            else $cargo = '';

            if (($cargo == 'Diputado') || ($cargo == 'Diputada'))
            {
            if (isset($intervencion['ORADOR']))
            {

            $diputado_id = Diputado::findOrCreate ($intervencion['ORADOR'])->id;

            if (isset($intervencion['INICIOINTERVENCION']))
                $inicio = $intervencion['INICIOINTERVENCION'];
            else $inicio =null;
            if (isset($intervencion['FININTERVENCION']))
                $fin = $intervencion['FININTERVENCION'];
            else $fin =null;
            $enlaceDiferido = $intervencion['ENLACEDIFERIDO'];
            $enlaceDescargaDirecta = $intervencion['ENLACEDESCARGADIRECTA'];
            $enlaceTextoIntegro = $intervencion['ENLACETEXTOINTEGRO'];
            $EnlacePDF = $intervencion['ENLACEPDF'];
            $enlaceSubtitles = "";

            $inter = Intervencion::where ('sesion', $sesion)->where('inicio', $inicio)->where ('fin', $fin)->first();

            if ($inter == null)
            {
            $intervencion_m = Intervencion::create (
                [
                    'legislatura' => $legislatura,
                    'objeto' => $objeto,
                    'sesion' => $sesion,
                    'organo' => $organo,
                    'fase' => $fase,
                    'tipoIntervencion' => $tipoIntervencion,
                    'diputado_id' => $diputado_id,
                    'cargo' => $cargo,
                    'inicio' => $inicio,
                    'fin' => $fin,
                    'enlaceDiferido' => $enlaceDiferido,
                    'enlaceDescargaDirecta' => $enlaceDescargaDirecta,
                    'enlaceTextoIntegro' => $enlaceTextoIntegro,
                    'EnlacePDF' => $EnlacePDF,
                    'enlaceSubtitles' => $enlaceSubtitles
                ]);

            //dd($intervencion_m);

            $intervencion_m->save();
            //dump($intervencion_m);
            }
            }
        }
        }*/
    }

    public function importar_intervenciones()
    {
/*        $ruta = 'https://www.congreso.es/opendata/intervenciones';
        $url = '';

        //dd($ruta);
        $doc = new \DOMDocument();
        @$doc->loadHTMLFile($ruta, LIBXML_NOWARNING | LIBXML_NOERROR);

        //dump ($doc);
        $as = $doc->getElementsByTagName ('a');
        foreach ($as as $a)
        {
            //dump ($a);
            $json = false;
                foreach ($a->attributes as $aattribute)
                {

                    if ($aattribute->nodeName == 'class')
                    {
                        if (($aattribute->nodeValue == 'btn btn-primary btn-vot') &&
                            ( str_contains($a->firstChild->data , 'JSON')))
                        {
                            $json = true;
                            //dump($json);
                        }
                    }
                    if (($aattribute->nodeName == 'href') && $json)
                    {
                        //dump ($aattribute->nodeValue);
                        //dump($json);
                        if (str_contains($aattribute->nodeValue, 'Cronologicamente'))
                            $url = $aattribute->nodeValue;
                    }
            }
        }


        $url = 'https://www.congreso.es' . $url;
        dump ($url);
        //$url = 'https://www.congreso.es/webpublica/opendata/intervenciones/IntervencionesCronologicamente__20220318050122.json';
        try
        {
            $this->importar_intervenciones_json ($url);
        }
        catch (Exception $e)
        {
            $this->congresoRepository->setImportarIntervenciones(false);
            dump ('Proceso terminado por excepcion');
            dump ($e);
        }*/
        $ruta    = 'https://www.congreso.es/opendata/intervenciones';
        $class   = 'btn btn-primary btn-vot';
        $pattern = '*Cronologicamente*.json';
        $urls = HTMLUtils::get_enlaces ($ruta, $class, $pattern);
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
        //$this->congresoRepository->setImportarIntervenciones(true);
        $this->importar_intervenciones();
        //$this->congresoRepository->setImportarIntervenciones(false);
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
        //$avance = new Avance ('INTERVENCIONES_ST', 'INTERVENCIONES_AV', sizeof($data));
        if (isset($this->avance))
            $this->avance->finalizar();
        //dump ($exception);
        dump ("Proceso terminado por excepción");
    }
}
