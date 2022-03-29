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
}
