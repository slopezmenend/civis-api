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
}
