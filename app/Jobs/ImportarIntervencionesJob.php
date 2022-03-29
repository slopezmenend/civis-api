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
use App\Models\Congreso\Modelos\Intervencion;

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

class ImportarIntervencionesJob implements ShouldQueue
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

    public function importar_intervenciones_json($url)
    {
        ini_set('max_execution_time', 0);
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
            /*$diputado = $this->congresoRepository->getDiputadoByName($intervencion['ORADOR']);
            if ($diputado == null)
            {
                //$nombre = $intervencion['ORADOR'];
                $nombre = explode('(',  $intervencion['ORADOR']);
                //como no hay diputado con su nombre cargamos uno con todos los datos iniciales para crear el id
                $diputado_t = Diputado::create (
                    [
                    'nombrecompleto' => $nombre[0]
                    ]);
                $diputado_t->save();
                $diputado_id = $diputado_t->id;
            }
            else
                $diputado_id = $diputado->id;
*/
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
        }
    }

    public function importar_intervenciones()
    {
        $ruta = 'https://www.congreso.es/opendata/intervenciones';
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
        $this->importar_intervenciones_json ($url);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->congresoRepository->setImportarIntervenciones(true);
        $this->importar_intervenciones();
        $this->congresoRepository->setImportarIntervenciones(false);
    }
}
