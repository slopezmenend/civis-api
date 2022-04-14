<?php

namespace App\Utils;

class HTMLUtils
{

public static function checkAttribute ($node, $name, $pattern)
{
    $value = false;

    $trozos = explode ('*', $pattern);
    //dump ($trozos);

    if ($node->nodeName == $name)
    {
        $value = true;
        foreach ($trozos as $trozo)
            $value = $value && str_contains($node->nodeValue , $trozo);
    }

    $ret = $value ? $node->nodeValue : null;
    //if ($value)
    //    dump ("CheckAttribute: ", $name, $pattern, $ret);
    return $ret;
}

public static function get_enlaces ($base, $class, $pattern, $prefijo = true)
    {
        //dump ("In. Get Enlaces: ", $base, $class, $pattern, $prefijo);
        $enlaces = [];

        //$pref = $prefijo ? explode('/', substr($base, 0, 10))[0] . "/" : "";
        $pref = 'https://www.congreso.es';
        //dump ("Prefijo: ", $pref);
        //cargamos el html de la página
        $doc = new \DOMDocument();
        @$doc->loadHTMLFile($base, LIBXML_NOWARNING | LIBXML_NOERROR);


        //partimos el patrón por '*' para transformar '*prueba*.json' en ['Prueba','.json']

        //recogemos los enlaces
        $as = $doc->getElementsByTagName ('a');
        foreach ($as as $a)
        {
            $classfound = false;
            $patternfound = false;
            $athref = '';

            //para cada uno buscamos los atributos class y href y aplicamos los patrones
            foreach ($a->attributes as $aattribute)
            {
                //dump ("Attribute check:---------");
                if (!$classfound)
                {
                    $atclass = HTMLUtils::checkAttribute ($aattribute, 'class', $class);
                    $classfound = $atclass != null;
                }

                if (!$patternfound)
                {
                    dump ("Comprobando enlace: ", $aattribute->nodeValue);
                    $athref = HTMLUtils::checkAttribute ($aattribute, 'href', $pattern);
                    $patternfound = $athref != null;
                }
            }

            if ($classfound && $patternfound)
            {
                dump ("Añadiendo enlace: ", $athref, $enlaces);
                array_push($enlaces, $pref . $athref);
            }
        }
        return $enlaces;
    }
}
?>
