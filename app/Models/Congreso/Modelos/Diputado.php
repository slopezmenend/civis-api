<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
                            'fechanacimiento',
                            'estudios'];

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
        $obj = Diputado::where('nombrecompleto', $nombre)->first();

        return isset($obj->id)? $obj : $diputado = Diputado::create (
            [
            'nombrecompleto' => $nombre
            ]) ;
    }
}
