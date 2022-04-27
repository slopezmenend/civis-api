<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    use HasFactory;
    protected $table = 'sexos';
    protected $fillable = ['nombre'];

    public function estadoCivil()
    {
        $ec = $this->belongsToMany(EstadoCivil::class);
        dump ($ec);
        return $ec;
    }

    public function diputados () {
        return Diputado::where('sexo_id' , $this->id)->count();
    }

    public static function findOrCreate ($nombre)
    {
        $sexo = Sexo::where ('nombre', $nombre);
        dump ("buscando sexo:", $nombre);
        if (isset($sexo->id))   dump ($sexo->id);
        else dump ("No encontrado");
        if (!isset($sexo->id))
        {
            $sexo = new Sexo();
            $sexo->nombre = $nombre;
            $sexo->save();
            //dump ("creado sexo ", $sexo);
        }
        return $sexo;
    }

    public static function inicializar()
    {
        if (Sexo::count() == 0)
        {
            Sexo::findOrCreate ('Hombre');
            Sexo::findOrCreate ('Mujer');
        }
    }

}
