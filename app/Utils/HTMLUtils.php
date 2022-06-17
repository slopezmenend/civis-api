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

public static function url_get_content ($url)
{
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: GUEST_LANGUAGE_ID=eu_ES; COOKIE_SUPPORT=true'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;
//echo $response;
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
        //@$doc->loadHTMLFile($base, LIBXML_NOWARNING | LIBXML_NOERROR);
        /*Cambio porque php_get_content dejó de funcionar*/
        $content = HTMLUtils::url_get_content ($base);
        @$doc->loadHTML($content, LIBXML_NOWARNING | LIBXML_NOERROR);

        //recogemos los enlaces
        $as = $doc->getElementsByTagName ('a');
//        dump ('Encontrados los enlaces: ', $as, $doc);
        foreach ($as as $a)
        {
            //dump ('Inicio de checkeo de enlace: ', a);
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
                //    if ($classfound) dump ('Encontrada clase:', $a);
                }

                if (!$patternfound)
                {
                    //dump ("Comprobando enlace: ", $aattribute->nodeValue);
                    $athref = HTMLUtils::checkAttribute ($aattribute, 'href', $pattern);
                    $patternfound = $athref != null;
                //    if ($patternfound) dump ('Encontrado pattron:', $a);
                }
            }

            if ($classfound && $patternfound)
            {
                dump ("Añadiendo enlace: ", $athref, $enlaces);
                array_push($enlaces, $pref . $athref);
                print_r($enlaces);
            }
        }

        return $enlaces;
    }
}
?>
