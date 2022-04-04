<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'grupos';
    protected $fillable = ['nombre'];

    public function diputados () {
        return Diputado::where('grupo_id' , $this->id)->count();
    }

    public static function findOrCreate ($nombre)
    {
        dump ("Findorcreate grupo", $nombre);
        $obj = Grupo::where('nombre', $nombre)->first();

        if (!isset($obj->id))
        {
            $obj = Grupo::create([
                'nombre' => $nombre
            ]);
            $obj->save();
        }
        dump ($obj);
        return $obj;
    }
}
