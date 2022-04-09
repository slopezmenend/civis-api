<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Utils\FormaterUtils;

class Voto extends Model
{
    use HasFactory;
    protected $table = 'votos';
    protected $fillable = ['votacion_id', 'diputado_id', 'voto'];
    protected $hidden = ['created_at', 'updated_at'];

    public function diputado () {
        return Diputado::find($this->diputado_id);
    }

    public static function createFromJSON ($data, $id=null)
    {
        $diputado_id = Diputado::findOrCreate (FormaterUtils::JSONValueOrNull ($data, 'diputado'))->id;
        $voto = Voto::where('votacion_id', $id)->where('diputado_id', $diputado_id)->first();
        if ($voto!=null)
        {
            //dump ("No creamos el voto porque ya existía ", $id, $diputado_id);
            return $voto;
        }

        $voto = new Voto();
        $voto->votacion_id = $id;
        $voto->diputado_id = $diputado_id;
        $voto->voto = FormaterUtils::JSONValueOrEmpty ($data, 'voto');

        $voto->save();

        //dump ("Creado voto");
        return $voto;
    }

}
