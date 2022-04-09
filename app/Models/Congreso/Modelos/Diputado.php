<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Utils\FormaterUtils;

class Diputado extends Model
{
    use HasFactory;

    protected $table = 'diputados';
    protected $fillable = [ 'id',
                            'nombrecompleto',
                            'nombre',
                            'apellidos',
                            'sexo_id',
                            'estadocivil_id',
                            'circunscripcion_id',
                            'partido_id',
                            'grupo_id',
                            'fechacondicionplena',
                            'fechaalta',
                            'fechaaltagrupo',
                            'biografia',
                            'numero',
                            'urlperfil',
                            'urlfoto',
                            'urlescaño',
                            'email',
                            'twitter',
                            'facebook',
                            'instagram',
                            'youtube',
                            'webpersonal'];

    public function circunscripcion ()
    {
        //return $this->hasOne('App\Models\Congreso\Modelos\Circunscripcion');
        //return $this->hasOne(Circunscripcion::class);
        //return "Circunscripcion";
        //return Circunscripcion::find($this->circunscripcion_id)->nombre;
        $circunscripcion = Circunscripcion::find($this->circunscripcion_id);

        $nombre = "";
        if (isset($circunscripcion->nombre))
            $nombre = $circunscripcion->nombre;
        return $nombre;
    }

    public function partido ()
    {
        /*$partido = $this->hasOne(Partido::class);
        dump($partido);
        return "Partido";*/
        //return Partido::find($this->partido_id)->nombre;
        $partido = Partido::find($this->partido_id);

        $nombre = "";
        if (isset($partido->nombre))
            $nombre = $partido->nombre;
        return $nombre;
    }

    public function revisado()
    {
        $diputado = DiputadoImportado::find($this->id);

        if ($diputado == null) return false;
        return $diputado->revisado;
    }

    public function grupo ()
    {
        /*$grupo = $this->partido->grupo;
        dump($grupo);
        return $grupo;*/
        $grupo = Grupo::find($this->grupo_id);

        $nombre = "";
        if (isset($grupo->nombre))
            $nombre = $grupo->nombre;
        return $nombre;
    }

    public function sexo ()
    {
        $sexo = $this->hasOne(Sexo::class);
        dump($sexo);
        return $sexo;
    }

    public function estadoCivil ()
    {
        $ec = $this->hasOne(EstadoCivil::class);
        dump($ec);
        return $ec;
    }

    public static function findOrCreate ($nombrecompleto)
    {
        //en muchos puntos de las referencias del congreso aparece "Fernandez, Juan (GMx)" en lugar de "Fernandez, Juan"
        //con esto eliinamos esa posibilidad.
        $nombre = explode('(', $nombrecompleto)[0];
        dump ("------- FIND OR CREATE ------");
        $obj = Diputado::where('nombrecompleto', $nombre)->first();
        if (($nombre== '') || ($nombre ==' ')) { dump ("Devuelto diputado", $obj); return null;}

        /*return isset($obj->id)? $obj : $diputado = Diputado::create (
            [
            'nombrecompleto' => $nombre

            ]);*/

        dump ($nombre);
        //dump ($obj);

        if (isset($obj->id)) { dump ("encontrado diputado", $obj->id); return $obj;}
        else
        {
            dump ("crear diputado");
            $diputado = new Diputado ();
            $diputado->nombrecompleto = $nombre;
            dump ($diputado);
            return $diputado;
        }
        dump ("-------------");
    }

    public static function createFromJSON ($data)
    {
        //dump ("Create from JSON: ", $data);
        $nombre = FormaterUtils::JSONValueOrEmpty ($data, 'NOMBRE');
        //dump ("Nombre: ", $nombre);
        $diputado = Diputado::where ('nombrecompleto', $nombre)->first();
        //dump ("Diputado buscado: ", $diputado);

        //la intervención ya existía así que no se crea
        if ($diputado != null)
        {
            dump ("No creamos diputado porque ya existía ");
            return $diputado;
        }

        $diputado = new Diputado ();
//        $intervencion->diputado_id = null;//FormaterUtils::JSONValueOrNull (Diputado::findOrCreate ($data, 'ORADOR')->id);
        $diputado->nombrecompleto =  $nombre;
        //dump ("Nombre completo ", $diputado->nombrecompleto);
        try{
            $trozos = explode(',', $nombre);
            $diputado->nombre = $trozos[1];
            $diputado->apellidos = $trozos[0];
            //dump ("Nombre y apellidos ", $diputado->nombre, $diputado->apellidos);
        }catch (Exception $e)
        {
            $diputado->nombre = '';
            $diputado->apellidos = '';
        }

//        sexo_id =
//        estadocivil_id =
        $diputado->circunscripcion_id = Circunscripcion::findOrCreate (FormaterUtils::JSONValueOrNull ($data, 'CIRCUNSCRIPCION'))->id;
        //dump ("Circunscripcion", $diputado->circunscripcion_id);
        $diputado->partido_id = Partido::findOrCreate (FormaterUtils::JSONValueOrNull ($data, 'FORMACIONELECTORAL'))->id;
        //dump ("Partido", $diputado->partido_id);
        $diputado->grupo_id = Grupo::findOrCreate (FormaterUtils::JSONValueOrNull ($data, 'GRUPOPARLAMENTARIO'))->id;
        //dump ("Grupo", $diputado->grupo_id);
        //$diputado->circunscripcion =  FormaterUtils::JSONValueOrEmpty ($data, 'CIRCUNSCRIPCION');
        //$diputado->formacionelectoral =  FormaterUtils::JSONValueOrEmpty ($data, 'FORMACIONELECTORAL');
        $diputado->fechacondicionplena =  FormaterUtils::convertir_json2sql_date (FormaterUtils::JSONValueOrNull ($data, 'FECHACONDICIONPLENA'));
        $diputado->fechaalta =  FormaterUtils::convertir_json2sql_date (FormaterUtils::JSONValueOrNull ($data, 'FECHAALTA'));
        //$diputado->grupoparlamentario =  FormaterUtils::JSONValueOrEmpty ($data, 'GRUPOPARLAMENTARIO');
        $diputado->fechaaltagrupo =  FormaterUtils::convertir_json2sql_date (FormaterUtils::JSONValueOrNull ($data, 'FECHAALTAENGRUPOPARLAMENTARIO'));
        $diputado->biografia =  FormaterUtils::JSONValueOrEmpty ($data, 'BIOGRAFIA');
        $diputado->fechaimportado = \DB::raw('CURRENT_TIMESTAMP');//'2022-04-03'; //fecha del día
        //fecharevision

        $diputado->save();

        dump ("Creado diputado:", $diputado->nombrecompleto);
        return $diputado;
    }
}
