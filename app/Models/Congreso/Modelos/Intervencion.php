<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Utils\FormaterUtils;

class Intervencion extends Model
{
    use HasFactory;
    protected $table = 'intervencions';
    protected $fillable = [
                            'legislatura',
    	                    'objeto',
                            'sesion',
                            'organo',
                            'fase',
                            'tipoIntervencion',
                            'diputado_id',
                            'cargo',
                            'inicio',
                            'fin',
                            'enlaceDiferido',
                            'enlaceDescargaDirecta',
                            'enlaceTextoIntegro',
                            'EnlacePDF',
                            'enlaceSubtitles'
    ]                   ;

    public function diputado () {
        return Diputado::find($this->diputado_id);
    }

    public static function createFromJSON ($data)
    {
        $cargo = FormaterUtils::JSONValueOrEmpty ($data, 'CARGOORADOR');
        //dump ("Cargo: ", $cargo);
        //sólo cargamos intervenciones de diputadas y diputados... en caso contrario no creamos
        if (($cargo != 'Diputada') && ($cargo != 'Diputado'))
        {
            dump ("No creamos intervencion por cargo ", $cargo);
            return null;
        }

        $sesion = FormaterUtils::convertir_json2sql_date (FormaterUtils::JSONValueOrNull($data, 'SESION'));
        $inicio = FormaterUtils::JSONValueOrNull ($data, 'INICIOINTERVENCION');
        $fin = FormaterUtils::JSONValueOrNull ($data, 'FININTERVENCION');
        if (($inicio == null) || ($fin == null))
            dump ("INICIO/FIN ERROR: ", $data);
        $intervencion = Intervencion::where ('sesion', $sesion)->where('inicio', $inicio)->where ('fin', $fin)->first();

        //la intervención ya existía así que no se crea
        if ($intervencion != null)
        {
            dump ("No creamos intervencion porque ya existía ", $sesion, $inicio, $fin);
            return $intervencion;
        }

        $intervencion = new Intervencion ();
        $intervencion->legislatura = 14;
        $intervencion->objeto = FormaterUtils::JSONValueOrEmpty ($data, 'OBJETOINICIATIVA');
        $intervencion->sesion = $sesion;
        $intervencion->organo = FormaterUtils::JSONValueOrEmpty ($data, 'ORGANO');
        $intervencion->fase = FormaterUtils::JSONValueOrEmpty ($data, 'FASE');
        $intervencion->tipoIntervencion = FormaterUtils::JSONValueOrEmpty ($data, 'TIPOINTERVENCION');
        $intervencion->diputado_id = Diputado::findOrCreate (FormaterUtils::JSONValueOrNull ($data, 'ORADOR'))->id;
        $intervencion->cargo = $cargo;
        $intervencion->inicio = $inicio;
        $intervencion->fin = $fin;
        $intervencion->enlaceDiferido = FormaterUtils::JSONValueOrEmpty ($data, 'ENLACEDIFERIDO');
        $intervencion->enlaceDescargaDirecta = FormaterUtils::JSONValueOrEmpty ($data, 'ENLACEDESCARGADIRECTA');
        $intervencion->enlaceTextoIntegro = FormaterUtils::JSONValueOrEmpty ($data, 'ENLACETEXTOINTEGRO');
        $intervencion->EnlacePDF = FormaterUtils::JSONValueOrEmpty ($data, 'ENLACEPDF');
        $intervencion->enlaceSubtitles = '';

        $intervencion->save();

        dump ("Creada intervencion");
        return $intervencion;
    }
}
