<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constante extends Model
{
    use HasFactory;
    protected $table = 'constantes';
    protected $fillable = ['name', 'value'];

    public static function findOrCreate ($name)
    {
        $cte = Constante::where('name', $name)->first();
        if ($cte == null)
        {
            $cte = new Constante ();
            $cte->name = $name;
            $cte->value = '0';
        }
        return $cte;
    }
}
