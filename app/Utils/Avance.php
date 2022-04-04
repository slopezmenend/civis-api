<?php

namespace App\Utils;
use App\Models\Constante;

class Avance
{
    private $constanteEstado = null;
    private $constanteAvance = null;
    private $total = 0;
    private $actual = 0;

    public function __construct($estado, $avance, $total)
    {
        $this->constanteEstado = Constante::findOrCreate($estado);
        $this->constanteAvance =  Constante::findOrCreate($avance);
        $this->total = $total;
        $this->inicializar();
    }

    public function avanzar ($actual)
    {
        dump ("Avanzar: ", $actual);
        $this->actual = $actual;
        if ($this->actual >= $this->total)
        {
            $this->finalizar();
        }
        else
        {
            if ($this->actual % 10 == 0)
            {
                $this->constanteAvance->value = $this->actual / $this->total;
                $this->constanteAvance->save();
            }
        }
    }

    public function inicializar ()
    {
        $this->constanteEstado->value = true;
        $this->constanteEstado->save();
        $this->constanteAvance->value = '0.00';
        $this->constanteAvance->save();
    }

    public function finalizar ()
    {
        $this->constanteEstado->value = false;
        $this->constanteEstado->save();
        $this->constanteAvance->value = '100.00';
        $this->constanteAvance->save();
    }
}
?>
