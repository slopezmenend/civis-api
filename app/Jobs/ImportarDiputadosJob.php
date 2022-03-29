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

class ImportarDiputadosJob implements ShouldQueue
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

    public function importar_diputados_json($url)
    {
        ini_set('max_execution_time', 0);
        //$url = 'https://www.congreso.es/webpublica/opendata/diputados/DiputadosActivos__20220314050019.json';

        $jsondata = file_get_contents($url);
        $data = json_decode($jsondata, true);

        //cargamos diputados importados
        foreach ($data as $diputado)
        {
            //dump ($diputado);
            $nombre =  $diputado['NOMBRE'];
            try{
                $trozos = explode(',', $nombre);
                $nombre_l = $trozos[1];
                $apellidos = $trozos[0];
            }catch (Exception $e)
            {
                $nombre_l = "";
                $apellidos = "";
            }

            $circunscripcion =  $diputado['CIRCUNSCRIPCION'];
            try {
                $circ = $this->congresoRepository->findOrCreateCircunscripcion($circunscripcion);//->id;
                $circunscripcion_id = $circ->id;
            } catch (Exception $e) {
                $circunscripcion_id = null;
            }
            $formacionelectoral =  $diputado['FORMACIONELECTORAL'];
            try {
                $part = $this->congresoRepository->findOrCreatePartido($formacionelectoral);
                $partido_id = $part->id;
            } catch (Exception $e) {
                $partido_id = null;
            }
            $fechacondicionplena =  convertir_json2sql_date ($diputado['FECHACONDICIONPLENA']);
            $fechaalta =  convertir_json2sql_date ($diputado['FECHAALTA']);
            $grupoparlamentario =  $diputado['GRUPOPARLAMENTARIO'];
            try{
                $grupo = $this->congresoRepository->findOrCreateGrupo($grupoparlamentario);
                $grupo_id = $grupo->id;
            } catch (Exception $e) {
                $grupo_id = null;
            }

            $fechaaltagrupo =  convertir_json2sql_date ($diputado['FECHAALTAENGRUPOPARLAMENTARIO']);
            if (isset($diputado['BIOGRAFIA']))
                $biografia = $diputado['BIOGRAFIA'];
            else
                $biografia =  "";

            $diputado_id = $this->congresoRepository->getDiputadoByName($diputado['NOMBRE']);
            if ($diputado_id == null)
            {
                //como no hay diputado con su nombre cargamos uno con todos los datos iniciales para crear el id
                $diputado_t = Diputado::create (
                    [
                    'nombrecompleto' => $nombre,
                    'nombre' => $nombre_l,
                    'apellidos' => $apellidos,
                    'sexo_id' => null,
                    'estadocivil_id' => null,
                    'circunscripcion_id' => $circunscripcion_id,
                    'partido_id' => $partido_id,
                    'grupo_id' => $grupo_id,
                    'fechacondicionplena' =>  $fechacondicionplena,
                    'fechaalta' =>  $fechaalta,
                    'fechaaltagrupo' =>  $fechaaltagrupo,
                    'biografia' =>  $biografia ,
                    'fechanacimiento' => null,
                    'estudios' => ''
                    ]);
                $diputado_t->save();
                $diputado_id = $diputado_t->id;
            }

            $diputado_imp = DiputadoImportado::create (
                [
                    'id' => $diputado_id,
                    'nombre' =>  $nombre,
                    'circunscripcion' =>  $circunscripcion,
                    'formacionelectoral' =>  $formacionelectoral,
                    'fechacondicionplena' =>  $fechacondicionplena,
                    'fechaalta' =>  $fechaalta,
                    'grupoparlamentario' =>  $grupoparlamentario,
                    'fechaaltagrupo' =>  $fechaaltagrupo,
                    'biografia' =>  $biografia
                ]);

            $diputado_imp->save();
        }
    }

    public function importar_diputados()
    {
        $ruta = 'https://www.congreso.es/opendata/diputados';
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
        //$this->importar_diputados_json ($url);
    }

    public function importar_diputados_html()
    {
        ini_set('max_execution_time', 0);
        $diputados_html = array ();

        for ($i = 1; $i <= 400; $i++) {
        //    $i = 71;
            $nombrecompleto = '';
            $email = '';
            $fotoperfil = '';
            $fotoescanio = '';
            $rrss = array();

            $ruta = 'https://www.congreso.es/busqueda-de-diputados?p_p_id=diputadomodule&p_p_lifecycle=0&p_p_state=normal&p_p_mode=view&_diputadomodule_mostrarFicha=true&codParlamentario='.$i.'&idLegislatura=XIV&mostrarAgenda=false';
            //dd($ruta);
            $doc = new \DOMDocument();
            @$doc->loadHTMLFile($ruta, LIBXML_NOWARNING | LIBXML_NOERROR);

            //dump ($doc);
            $imgs = $doc->getElementsByTagName ('img');
            //dump ($imgs);
            foreach ($imgs as $img)
            {
                $esperfil = false;
                foreach ($img->attributes as $imgattribute)
                {
                    if ($imgattribute->nodeName == 'class' && $imgattribute->nodeValue == 'card-img-top')
                        $esperfil = true;
                    if ($imgattribute->nodeName == 'src' && $esperfil)
                        $fotoperfil = 'https://www.congreso.es/' . $imgattribute->nodeValue;
                }
            }

            //dump ($fotoperfil);

            $divs = $doc->getElementsByTagName ('div');
            //dump ($divs);

            foreach ($divs as $div)
            {
                //echo $div->nodeName, PHP_EOL;
                foreach ($div->attributes as $attribute)
                {
                    if ($attribute->nodeName == 'class')
                    {
                        if ($attribute->nodeValue == 'ico-escanyo')
                        {
                            foreach ($div->childNodes as $child)
                                if ($child->nodeName == 'img')
                                    foreach ($child->attributes as $childatt)
                                        if ($childatt->nodeName == 'src')
                                            $fotoescanio = 'https://www.congreso.es/' . $childatt->nodeValue;
                        }
                        if ($attribute->nodeValue == 'nombre-dip')
                            $nombrecompleto = trim($div->firstChild->nodeValue);
                        if ($attribute->nodeValue == 'email-dip')
                        {
                            foreach ($div->childNodes as $child)
                            {
                                if ($child->nodeName == 'a')
                                    $email = $child->firstChild->data;
                            }
                        }
                        if ($attribute->nodeValue == 'rrss-dip')
                        {
                            $rs_name = '';
                            $rs_url = '';

                            foreach ($div->childNodes as $child)
                            {
                                if ($child->nodeName == 'a')
                                {
                                    foreach ($child->childNodes as $childnode)
                                        if ($childnode->nodeName == 'img')
                                            foreach ($childnode->attributes as $rrsschildatt)
                                                if ($rrsschildatt->nodeName == 'alt')
                                                    $rs_name = $rrsschildatt->nodeValue;

                                    foreach ($child->attributes as $attribute2)
                                    {
                                        if ($attribute2->nodeName == 'href')
                                        {
                                            $rs_url = $attribute2->nodeValue;
                                            if ($rs_name != '')
                                                $rrss[$rs_name] = $rs_url;
                                        }
                                    }
                                }
                            }
                        }

                        }
                }
             //       echo "\t", $attribute->nodeName , ": ", $attribute->nodeValue, PHP_EOL;
            }

            if ($nombrecompleto != '')
            {
                $diputado_html = array (
                    "nombre" => $nombrecompleto,
                    "email"  => $email,
                    "foto"   => $fotoperfil,
                    "escaño" => $fotoescanio,
                    "rrss" => $rrss
                );

                //dump ($diputado_html);
                array_push ($diputados_html, $diputado_html);
            }



            //dump ($doc);
            /*$xpath = new \DomXPath($doc);
            dump ($xpath);

$nodeList = $xpath->query("//div[@class='nombre-dip']");
dump ($nodeList);
// To check the result:
$result = json_encode($nodeList);
echo "<p>" . $result . "</p>";*/

            /*
        // example 1:
        $elements = $doc->getElementsByClass('nombre-dip');
        // example 2:
        //$elements = $doc->getElementsByTagName('html');
        // example 3:
        //$elements = $doc->getElementsByTagName('body');
        // example 4:
        //$elements = $doc->getElementsByTagName('table');
        // example 5:
        //$elements = $doc->getElementsByTagName('div');

        if (!is_null($elements)) {
          foreach ($elements as $element) {
            //echo "<br/>".$element->getAttribute('href');;

            $nodes = $element->childNodes;
            foreach ($nodes as $node) {
              echo $node->nodeValue. "\n";
            }
          }

        }*/

        }
        dump ($diputados_html);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }
}
