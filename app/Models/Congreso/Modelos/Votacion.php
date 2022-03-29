<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    use HasFactory;

    protected $table = 'votacions';
    protected $fillable = [ 'sesion',
                            'numeroVotacion',
                            'fecha' ,
                            'titulo' ,
                            'textoExpediente',
                            'asentimiento',
                            'presentes',
                            'afavor',
                            'enContra',
                            'abstenciones',
                            'noVotan'];
    protected $hidden = ['created_at', 'updated_at'];

    public $timestamps = false;

    public function aprobada ()
    {
        return ($this->afavor > $this->enContra);
    }
}
