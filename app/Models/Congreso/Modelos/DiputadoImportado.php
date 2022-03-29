<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiputadoImportado extends Model
{
    use HasFactory;
    protected $table = 'diputado_importados';
    protected $fillable = ['id', 'nombre','circunscripcion','formacionelectoral','fechacondicionplena','fechaalta','grupoparlamentario','fechaaltagrupo','biografia','numero','urlperfil', 'urlfoto', 'urlescaño', 'biografiahtml'];

}
