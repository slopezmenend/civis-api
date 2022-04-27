<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    use HasFactory;
    protected $table = 'estado_civils';
    protected $fillable = ['sexo_id', 'nombre'];

    public function sexo()
    {
        $sexo = $this->hasOne(Sexo::class);
        dump ($sexo);
        return $sexo;
    }

    public function diputado()
    {
        $dip = $this->belongsToMany(Diputado::class);
        dump ($dip);
        return $dip;
    }

    public function diputados () {
        //dd(Diputado::where('estadocivil_id' , $this->id)->count());
        return Diputado::where('estadocivil_id' , $this->id)->count();
    }

    public static function findOrCreate ($sexo_id, $nombre_estado)
    {
        //$sexo = Sexo::where ('nombre', $nombre_sexo);
        $estado = EstadoCivil::where ('nombre', $nombre_estado)->where('sexo_id', $sexo_id);
        dump ("buscando estado:", $nombre_estado);
        if (isset($estado->id))   dump ($estado->id);
        else dump ("No encontrado");

        if (!isset($estado->id))
        {
            $estado = new EstadoCivil();
            $estado->sexo_id = $sexo_id;
            $estado->nombre = $nombre_estado;
            $estado->save();
            dump ("creado estado civil ", $estado);
        }

        return $estado;
    }

    public static function inicializar()
    {
        dump ("estado civil inicializar");
        EstadoCivil::findOrCreate (1, 'Soltero');
        EstadoCivil::findOrCreate (1, 'Casado');
        EstadoCivil::findOrCreate (1, 'Divorciado');
        EstadoCivil::findOrCreate (1, 'Viudo');
        //EstadoCivil::findOrCreate ('Mujer');
        EstadoCivil::findOrCreate (2, 'Soltera');
        EstadoCivil::findOrCreate (2, 'Casada');
        EstadoCivil::findOrCreate (2, 'Divorciada');
        EstadoCivil::findOrCreate (2, 'Viuda');
    }
}
