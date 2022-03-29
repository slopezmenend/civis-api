<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    use HasFactory;
    protected $table = 'votos';
    protected $fillable = ['votacion_id', 'diputado_id', 'voto'];
    protected $hidden = ['created_at', 'updated_at'];

    public function diputado () {
        return Diputado::find($this->diputado_id);
    }

}
