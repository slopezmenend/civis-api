<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Utils\FormaterUtils;

class DiputadoImportado extends Model
{
    use HasFactory;
    protected $table = 'diputado_importados';
    protected $fillable = [ 'id',
                            'nombre',
                            'circunscripcion',
                            'formacionelectoral',
                            'fechacondicionplena',
                            'fechaalta',
                            'grupoparlamentario',
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
                            'webpersonal',
                            'revisado'];

    public static function createFromJSON ($data)
    {
        dump ("Create from JSON (I): ", $data);
        $nombre = FormaterUtils::JSONValueOrEmpty ($data, 'NOMBRE');
        dump ("Nombre: ", $nombre);
        $diputado = DiputadoImportado::where ('nombre', $nombre)->first();
        dump ("Diputado buscado: ", $diputado);

        //la intervención ya existía así que no se crea
        if ($diputado != null)
        {
            dump ("No creamos diputado porque ya existía ");
            return $diputado;
        }

        //esto crea el diputado si no existe con los datos básicos y lo devuelve si ya existía
        $dipu = Diputado::createFromJSON ($data);

        $diputado = new DiputadoImportado ();
        $diputado->nombre =  $nombre;
        //$dipu = Diputado::findOrCreate ($nombre);
        if ($dipu != null)
            $diputado->id = $dipu->id;

        //$diputado->id = FormaterUtils::JSONValueOrNull ($dipu->id);
        $diputado->circunscripcion =  FormaterUtils::JSONValueOrEmpty ($data, 'CIRCUNSCRIPCION');
        $diputado->formacionelectoral =  FormaterUtils::JSONValueOrEmpty ($data, 'FORMACIONELECTORAL');
        $diputado->fechacondicionplena =  FormaterUtils::convertir_json2sql_date (FormaterUtils::JSONValueOrNull ($data, 'FECHACONDICIONPLENA'));
        $diputado->fechaalta =  FormaterUtils::convertir_json2sql_date (FormaterUtils::JSONValueOrNull ($data, 'FECHAALTA'));
        $diputado->grupoparlamentario =  FormaterUtils::JSONValueOrEmpty ($data, 'GRUPOPARLAMENTARIO');
        $diputado->fechaaltagrupo =  FormaterUtils::convertir_json2sql_date (FormaterUtils::JSONValueOrNull ($data, 'FECHAALTAENGRUPOPARLAMENTARIO'));
        $diputado->biografia =  FormaterUtils::JSONValueOrEmpty ($data, 'BIOGRAFIA');

        $diputado->save();

        dump ("Creado diputadoImoortado:", $diputado);
        return $diputado;
    }

}
