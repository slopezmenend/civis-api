<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CongresoRepositoryInterface;
use DateTime;
use DateInterval;
use App\Models\Congreso\Modelos\Votacion;
use App\Models\Congreso\Modelos\Voto;
use App\Models\Congreso\Modelos\DiputadoImportado;
use App\Models\Congreso\Modelos\Diputado;
use App\Models\Congreso\Modelos\Circunscripcion;
use App\Models\Congreso\Modelos\Partido;
use App\Models\Congreso\Modelos\Grupo;
use App\Scripts\ImportadorVotaciones;

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
        $votacion->save();

        //cargamos votos
        foreach ($data['votaciones'] as $votojson)
        {
            $diputado_id = $this->congresoRepository->getDiputadoByName($votojson['diputado']);
            //quitar cuando carguemos los diputados
            $diputado_id = 1;
            $voto = Voto::create (
                [
                    'votacion_id' => $votacion->id,
                    'voto' => $votojson['voto'],
                    'diputado_id' => $diputado_id
                ]);

            //dump ($voto);
            $voto->save();
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
        $date->setDate(2020, 6, 1);
        $enddate = new DateTime();
        $enddate->setDate(2020, 6, 6);
        //$i = 0;
        while ($enddate > $date)
        {
            $filedate = $date->format('d/m/Y');
            $this->get_date_votes ($filedate);
            $date = $date->add (new DateInterval('P1D'));
        }
    }

    public function importar_diputados()
    {
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

}
?>
