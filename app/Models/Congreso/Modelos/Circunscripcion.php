<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circunscripcion extends Model
{
    use HasFactory;
    protected $table = 'circunscripciones';
    protected $fillable = ['nombre'];

    public function diputado()
    {
        return $this->hasMany(Diputado::class);
    }

    public function diputados () {
        return Diputado::where('circunscripcion_id' , $this->id)->count();
    }

    public static function findOrCreate ($nombre)
    {
        $obj = Circunscripcion::where('nombre', $nombre)->first();
        dump ($nombre);
        dump ($obj);
        dump (isset($obj->id));
        if (!isset($obj->id))
        {
            $obj = Circunscripcion::create([
                'nombre' => $nombre
            ]);
            $obj->save();
        }

        return $obj;
    }
}
