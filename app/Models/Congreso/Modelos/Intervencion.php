<?php

namespace App\Models\Congreso\Modelos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervencion extends Model
{
    use HasFactory;
    protected $table = 'intervencions';
    protected $fillable = [
                            'legislatura',
    	                    'objeto',
                            'sesion',
                            'organo',
                            'fase',
                            'tipoIntervencion',
                            'diputado_id',
                            'cargo',
                            'inicio',
                            'fin',
                            'enlaceDiferido',
                            'enlaceDescargaDirecta',
                            'enlaceTextoIntegro',
                            'EnlacePDF',
                            'enlaceSubtitles'
    ]                   ;

    public function diputado () {
        return Diputado::find($this->diputado_id);
    }
}
