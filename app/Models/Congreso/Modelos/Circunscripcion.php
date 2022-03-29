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

}
