<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    public $fillable = [    'importando_diputados',
                            'avance_diputados',
                            'importando_votaciones',
                            'avance_votaciones',
                            'importando_intervenciones',
                            'avance_intervenciones' ];
}
