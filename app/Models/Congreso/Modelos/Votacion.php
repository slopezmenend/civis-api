<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Utils\FormaterUtils;

class Votacion extends Model
{
    use HasFactory;

    protected $table = 'votacions';
    protected $fillable = [ 'sesion',
                            'numeroVotacion',
                            'fecha' ,
                            'titulo' ,
                            'textoExpediente',
                            'asentimiento',
                            'presentes',
                            'afavor',
                            'enContra',
                            'abstenciones',
                            'noVotan'];
    protected $hidden = ['created_at', 'updated_at'];

    public $timestamps = false;

    public function aprobada ()
    {
        return ($this->afavor > $this->enContra);
    }

    public static function createFromJSON ($data)
    {
        $sesion = FormaterUtils::JSONValueOrNull ($data['informacion'],'sesion');
        $numeroVotacion = FormaterUtils::JSONValueOrNull ($data['informacion'],'numeroVotacion');

        $votacion_b = Votacion::where('sesion', $sesion)->where('numeroVotacion', $numeroVotacion)->first();

        if ($votacion_b != null)
        {
            //dump ("No creamos votación porque ya existía ", $sesion, $numeroVotacion);
            return $votacion_b;
        }

        $votacion = new Votacion ();
        $votacion->sesion =  $sesion;
        $votacion->numeroVotacion = $numeroVotacion;
        $votacion->fecha = FormaterUtils::convertir_json2sql_date (FormaterUtils::JSONValueOrNull($data['informacion'],'fecha'));
        $votacion->titulo = FormaterUtils::JSONValueOrEmpty ($data['informacion'],'titulo');
        $votacion->textoExpediente = FormaterUtils::JSONValueOrEmpty ($data['informacion'], 'textoExpediente');
        $votacion->asentimiento = FormaterUtils::JSONValueOrEmpty ($data['totales'],'asentimiento');
        $votacion->presentes = FormaterUtils::JSONValueOrNull ($data['totales'],'presentes');
        $votacion->afavor = FormaterUtils::JSONValueOrNull ($data['totales'],'afavor');
        $votacion->enContra = FormaterUtils::JSONValueOrNull ($data['totales'],'enContra');
        $votacion->abstenciones = FormaterUtils::JSONValueOrNull ($data['totales'],'abstenciones');
        $votacion->noVotan = FormaterUtils::JSONValueOrNull ($data['totales'],'noVotan');

        $votacion->save();

        //dump ("Creada votacion");
        return $votacion;
    }
}
