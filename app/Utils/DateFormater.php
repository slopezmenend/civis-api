<?php

namespace App\Utils;

class DateFormater
{

    public static function convertir_json2sql_date ($date)
    {
        $trozos = explode('/', $date);
        $fecha_temp = $trozos[2] . "-" . $trozos[1] . "-" . $trozos[0];
        return $fecha_temp;
    }

    public static function convertir_sql2json_date ($date)
    {
        $trozos = explode('-', $date);
        $trozos2 = explode(' ',$trozos[2]);
        $fecha_temp = $trozos2[0] . "/" . $trozos[1] . "/" . $trozos[0];
        return $fecha_temp;
    }

    private static function convertir2date ($date, $sep, $ord)
    {
        $trozos = explode($sep, $date);
        //dump ($trozos);
        //dump($date);
        if (!isset($trozos[2])) return null;
        $ddate = new \DateTime();
        if ($ord == 'X')
        $ddate->setDate($trozos[0], $trozos[1], $trozos[2]);
        else
            $ddate->setDate($trozos[2], $trozos[1], $trozos[0]);
        return $ddate;
    }

    public static function convertir_string2date ($date)
    {
        $fecha = DateFormater::convertir2date ($date, '/', '');
        if ($fecha == null)
            $fecha = DateFormater::convertir2date ($date, '-', 'X');
        return $fecha;
    }
}
?>
