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

    private CongresoRepositoryInterface $congresoRepository;

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
        $fecha = convertir_json2sql_date ($data['informacion']['fecha']);

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

        //dump ($votacion);
        echo "<li>".$fecha."Cargada sesion ".$sesion. " votación ".$numeroVotacion."</li>";
        $votacion->save();

        //cargamos votos
        foreach ($data['votaciones'] as $votojson)
        {
            $diputado = $this->congresoRepository->getDiputadoByName($votojson['diputado']);
            if (!isset($diputado->id))
            {
                $diputado = Diputado::create (
                    [
                    'nombrecompleto' => $votojson['diputado']
                    ]);
                //dump ($votojson);
                //dd ($diputado);
            }
            $diputado_id = $diputado->id;
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
        $date = new DateTime();
        $date->setDate(2019, 12, 3);
        $enddate = new DateTime();
        $enddate->setDate(2022, 3, 15);
        //$i = 0;
        //echo "<ol>";
        while ($enddate > $date)
        {
            $filedate = $date->format('d/m/Y');
            $this->get_date_votes ($filedate);
            $date = $date->add (new DateInterval('P1D'));
        }
        //echo "</ol>";
    }

    public function importar_diputados()
    {
        ini_set('max_execution_time', 0);
        $url = 'https://www.congreso.es/webpublica/opendata/diputados/DiputadosActivos__20220314050019.json';

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

    public function importar_intervenciones()
    {
        ini_set('max_execution_time', 0);
        $url = 'https://www.congreso.es/webpublica/opendata/intervenciones/IntervencionesCronologicamente__20220318050122.json';
        $jsondata = file_get_contents($url);
        $data = json_decode($jsondata, true);

        //cargamos diputados importados
        foreach ($data as $intervencion)
        {
            //dump ($intervencion);
            $legislatura = 14;
            $objeto = $intervencion['OBJETOINICIATIVA'];
            $sesion =  convertir_json2sql_date ($intervencion['SESION']);
            $organo = $intervencion['ORGANO'];
            if (isset($intervencion['FASE']))
            $fase = $intervencion['FASE'];
            else $fase = '';

            $tipoIntervencion = $intervencion['TIPOINTERVENCION'];
            if (isset($intervencion['ORADOR']))
            {
            $diputado = $this->congresoRepository->getDiputadoByName($intervencion['ORADOR']);
            if ($diputado == null)
            {
                $nombre = $intervencion['ORADOR'];
                //como no hay diputado con su nombre cargamos uno con todos los datos iniciales para crear el id
                $diputado_t = Diputado::create (
                    [
                    'nombrecompleto' => $nombre,
                    ]);
                $diputado_t->save();
                $diputado_id = $diputado_t->id;
            }
            else
                $diputado_id = $diputado->id;

            if (isset($intervencion['CARGOORADOR']))
            $cargo = $intervencion['CARGOORADOR'];
            else $cargo = '';
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
            }
        }
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

    public function import_diputados_job ()
    {
        ImportarDiputadosJob::dispatch($this->congresoRepository);
        return redirect('/')->with('success', 'Proceso de importado de diputados lanzado correctamente');
        //return response('Email sent successfully');
    }

    public function import_votaciones_job ()
    {
        ImportarVotacionesJob::dispatch($this->congresoRepository);
        return redirect('/')->with('success', 'Proceso de importado de votaciones lanzado correctamente');
        //return response('Email sent successfully');
    }

    public function import_intervenciones_job ()
    {
        ImportarIntervencionesJob::dispatch($this->congresoRepository);
        return redirect('/')->with('success', 'Proceso de importado de intervenciones lanzado correctamente');
        //return response('Email sent successfully');
    }

    public function test()
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

        dump ($url);
        //$url = 'https://www.congreso.es/webpublica/opendata/intervenciones/IntervencionesCronologicamente__20220318050122.json';
        //$this->importar_intervenciones_json ($url);
    }
}
?>
