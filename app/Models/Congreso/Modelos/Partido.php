<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $table = 'partidos';
    protected $fillable = ['nombre', 'urllogo'];

    public static function findOrCreate ($nombre)
    {
        $obj = Partido::where('nombre', $nombre)->first();

        if (!isset($obj->id))
        {
            $obj = Partido::create([
                'nombre' => $nombre
            ]);
            $obj->save();
        }
        return $obj;
    }
}
