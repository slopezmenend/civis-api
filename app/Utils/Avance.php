<?php

namespace App\Utils;
use App\Models\Constante;

class Avance
{
    private $constanteEstado = null;
    private $constanteAvance = null;
    private $total = 0;
    private $actual = 0;
    //private $upd = 10;

    public function __construct($estado, $avance, $total)
    {
        $this->constanteEstado = Constante::findOrCreate($estado);
        $this->constanteAvance =  Constante::findOrCreate($avance);
        $this->total = $total;
        //$upd = round($this->total / 10000, 0);
        //if ($upd == 0) $upd = 1;
        $this->inicializar();
    }

    public function avanzar ($actual)
    {
        //dump ("Avanzar: ", $this->upd, $this->total, $actual, $actual%$this->upd, "----");
        $this->actual = $actual;
        if ($this->actual >= $this->total)
        {
            $this->finalizar();
        }
        else
        {
            //if (($this->upd == 1) || ($this->actual % $this->upd == 0))
            //{
                $this->constanteAvance->value = round(($this->actual / $this->total) * 100, 2);
            //    dump ("Value: ", $this->constanteAvance->value);
                $this->constanteAvance->save();
            //}
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
