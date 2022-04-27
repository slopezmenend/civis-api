<?php

namespace App\Repositories;

use App\Interfaces\CongresoRepositoryInterface;
use App\Models\Congreso\Modelos\Diputado;
use App\Models\Congreso\Modelos\DiputadoImportado;
use App\Models\Congreso\Modelos\Intervencion;
use App\Models\Congreso\Modelos\Votacion;
use App\Models\Congreso\Modelos\Voto;
use App\Models\Congreso\Modelos\Circunscripcion;
use App\Models\Congreso\Modelos\Partido;
use App\Models\Congreso\Modelos\Grupo;
use App\Models\Congreso\Modelos\EstadoCivil;
use App\Models\Congreso\Modelos\Sexo;
use App\Models\Constante;

class CongresoRepository implements CongresoRepositoryInterface
{
    private function convertir_json2sql_date ($date)
{
    $trozos = explode('/', $date);
    $fecha_temp = $trozos[0] . "-" . $trozos[1] . "-" . $trozos[2];
    return $fecha_temp;
}

private function convertir_sql2json_date ($date)
{
    if ($date == null) return "00/00/0000";
    //dump ($date);
    $trozos = explode('-', $date);
    $trozos2 = explode(' ', $trozos[2]);
    //dump ($trozos);
    $fecha_temp = $trozos2[0] . "/" . $trozos[1] . "/" . $trozos[0];
    //dd ($fecha_temp);
    return $fecha_temp;
}

    //private Status $status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->status = Status::first();
    }

    /*public function getAllDiputados()
    {
        return Diputado::orderBy('nombrecompleto')->paginate(15);
    }

    public function getDiputadoById($id) {
        return Diputado::find($id);
    }
    public function getDiputadoByName($nombre){
        return Diputado::where('nombrecompleto', $nombre)->first();
    }

    public function getAllVotacionesSummary() {
        return Votacion::all();
    }

    public function getVotacionesSummaryByDate($date) {
        $data = Votacion::where('fecha', '=', $date)->get();
        return $data;
    }
    public function getVotacionDetail($id) {return Votacion::find($id);}
    public function getVotacionDetailVotos($id)
    {
        $data = Voto::where('votacion_id', '=', $id)->get();
        return $data;
    }
    public function getVotacionesSumaryByDiputadoId($id) {
        $data = Voto::where('diputado_id', '=', $id)->get();
        return $data;
    }

    public function getAllIntervenciones() {
        return Intervencion::all();
    }

    public function getIntervencionesByDate($date) {
        $data = Intervencion::where('sesion', '=', $date)->get();
        return $data;
    }
    public function getIntervencion($id) {return Intervencion::find($id);}
    public function getIntervencionByDiputadoId ($id) {
        $data = Intervencion::where('diputado_id', '=', $id)->get();
        return $data;
    }

    public function findOrCreateCircunscripcion ($nombre)
    {
        $obj = Circunscripcion::where('nombre', $nombre)->first();
        if (!isset($obj->id))
        {
            $obj = Circunscripcion::create([
                'nombre' => $nombre
            ]);
            $obj->save();
        }
        dump ('Find or Create Circunscripcion' , $nombre, $obj);
        return $obj;
    }

    public function findOrCreateGrupo ($nombre)
    {
        $obj = Grupo::where('nombre', $nombre)->first();

        if (!isset($obj->id))
        {
            $obj = Grupo::create([
                'nombre' => $nombre
            ]);
            $obj->save();
        }
        dump ('Find or Create Grupo' , $nombre, $obj);
        return $obj;
    }

    public function findOrCreatePartido ($nombre)
    {
        dump ('Find or Create Partido' , $nombre);
        $obj = Partido::where('nombre', $nombre)->first();

        dump ('Where Find or Create Partido' , $obj);
        dump (isset($obj->id));
        if (!isset($obj->id))
        {
            $obj = new Partido();
            $obj->nombre = $nombre;
            /*$obj = Partido::create([
                'nombre' => $nombre
            ]);////FIN COMENTARIO
            dump ('Creamos en Find or Create Partido' , $obj);
            $obj->save();
        }
        dump ('Fin Find or Create Partido' , $obj);
        return $obj;
    }

    public function getFechaUltimaVotacion()
    {
        //return $this->convertir_sql2json_date(Votacion::max('fecha'));
        return Votacion::max('fecha');
    }*/

    public function getSummaryData ()
    {
        try{
        $diputados_data = array (
            "creados" => Diputado::count(),
            "pendientes" => DiputadoImportado::where('revisado',false)->count(),
            "fechaimp" =>$this->convertir_sql2json_date(DiputadoImportado::max('fechaimp')),
            "status" => Constante::findOrCreate('DIPUTADOS_ST')->value,
            "porcentaje" => Constante::findOrCreate('DIPUTADOS_AV')->value
        );

        $votaciones_data = array (
            "votaciones" => Votacion::count(),
            "votos" => Voto::count(),
            "fechaimp" => $this->convertir_sql2json_date(Votacion::max('fecha')),
            "status" => Constante::findOrCreate('VOTACIONES_ST')->value,
            "porcentaje" => Constante::findOrCreate('VOTACIONES_AV')->value
        );
        //dump ($votaciones_data);

        $intervenciones_data = array (
            "creados" => Intervencion::count(),
            "pendientes" => Intervencion::where('enlaceSubtitles','')->count(),
            "fechaimp" => $this->convertir_sql2json_date(Intervencion::max('created_at')),
            "status" => Constante::findOrCreate('INTERVENCIONES_ST')->value,
            "porcentaje" => Constante::findOrCreate('INTERVENCIONES_AV')->value
        );


        //dump ($intervenciones_data);

        $data = array (
            //"status" => Status::first(),
            "diputados" => $diputados_data,
            "votaciones"  => $votaciones_data,
            "intervenciones"   => $intervenciones_data,
            "partidos" => Partido::count(),
            "grupos" => Grupo::count(),
            "circunscripciones" => Circunscripcion::count(),
            "estadosciviles" => EstadoCivil::count(),
            "sexos" => Sexo::count()
        );
        } catch (Exception $e) {
            $diputados_data = array (
                "creados" => 0,
                "pendientes" => 0,
                "fechaimp" => "0000-00-00",
                "status" => 0,
                "porcentaje" => 0
            );

            $votaciones_data = array (
                "votaciones" => 0,
                "votos" => 0,
                "fechaimp" => "0000-00-00",
                "status" => 0,
                "porcentaje" => 0
            );
            //dump ($votaciones_data);

            $intervenciones_data = array (
                "creados" => 0,
                "pendientes" => 0,
                "fechaimp" => "0000-00-00",
                "status" => 0,
                "porcentaje" => 0
            );


            //dump ($intervenciones_data);

            $data = array (
                //"status" => Status::first(),
                "diputados" => $diputados_data,
                "votaciones"  => $votaciones_data,
                "intervenciones"   => $intervenciones_data,
                "partidos" => 0,
                "grupos" => 0,
                "circunscripciones" => 0,
                "estadosciviles" => 0,
                "sexos" => 0
            );

        }
        //dump ("Avance votaciones: ", $data['votaciones']['porcentaje']);
        return $data;
    }

    /*public function setImportarVotacionesPerc ($perc)
    {
        $this->status->avance_votaciones = $perc;
        $this->status->update();
    }

    public function setImportarVotaciones ($valor)
    {
        $this->status->importando_votaciones = $valor;
        if ($valor)
            $this->status->avance_votaciones = 0;
        else
            $this->status->avance_votaciones = 100;
        $this->status->update();
    }

    public function setImportarIntervencionesPerc ($perc)
    {
        $this->status->avance_intervenciones = $perc;
        $this->status->update();
    }

    public function setImportarIntervenciones ($valor)
    {
        $this->status->importando_intervenciones = $valor;
        if ($valor)
            $this->status->avance_intervenciones = 0;
        else
            $this->status->avance_intervenciones = 100;
        $this->status->update();
    }

    public function setImportarDiputadosPerc ($perc)
    {
        $this->status->avance_diputados = $perc;
        $this->status->update();
    }

    public function setImportarDiputados ($valor)
    {
        $this->status->importando_diputados = $valor;
        if ($valor)
            $this->status->avance_diputados = 0;
        else
            $this->status->avance_diputados = 100;
        $this->status->update();
    }*/
}

