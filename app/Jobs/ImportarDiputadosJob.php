<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Congreso\Modelos\DiputadoImportado;
use App\Models\Congreso\Modelos\Diputado;
use App\Models\Congreso\Modelos\Sexo;
use App\Models\Congreso\Modelos\EstadoCivil;

use App\Utils\HTMLUtils;
use App\Utils\Avance;

use App\Utils\FormaterUtils;

class ImportarDiputadosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Avance $avance;

    public function importar_diputados_json($url)
    {
        //hacemos que no se boquee el job por timeout
        ini_set('max_execution_time', 0);

        //leemos las intervenciones del json indicado
        $jsondata = file_get_contents($url);
        $data = json_decode($jsondata, true);

        //ahora creamos el objeto de avance para mostrar el progreso
        $this->avance = new Avance ('DIPUTADOS_ST', 'DIPUTADOS_AV', sizeof($data));
        $contador = 0;
        foreach ($data as $diputado)
        {
            //creamos el diputado para cada registro
            $dipu = DiputadoImportado::createFromJSON ($diputado);

            //avanzamos el avance
            $this->avance->avanzar($contador = $contador + 1);
        }
    }

    public function importar_diputados(){
        $ruta    = 'https://www.congreso.es/opendata/diputados';
        $class   = 'btn btn-primary btn-vot';
        $pattern = '*DiputadosActivos*.json';
        $urls = HTMLUtils::get_enlaces ($ruta, $class, $pattern);
        foreach ($urls as $url)
        {
            dump("URL: ", $url);
            $this->importar_diputados_json($url);
        }
    }

    public function importar_diputados_html()
    {
        ini_set('max_execution_time', 0);
        $diputados_html = array ();

        $this->avance = new Avance ('DIPUTADOS_ST', 'DIPUTADOS_AV', 400);
        for ($i = 1; $i <= 400; $i++) {
       //     $i = 381; {
            $nombrecompleto = '';
            $email = '';
            $fotoperfil = '';
            $fotoescanio = '';
            $rrss = array();

            //avanzamos el avance
            $this->avance->avanzar($i);
            $ruta = 'https://www.congreso.es/busqueda-de-diputados?p_p_id=diputadomodule&p_p_lifecycle=0&p_p_state=normal&p_p_mode=view&_diputadomodule_mostrarFicha=true&codParlamentario='.$i.'&idLegislatura=XIV&mostrarAgenda=false';

            $doc = new \DOMDocument();
            @$doc->loadHTMLFile($ruta, LIBXML_NOWARNING | LIBXML_NOERROR);

            $imgs = $doc->getElementsByTagName ('img');
            foreach ($imgs as $img)
            {
                $esperfil = false;
                foreach ($img->attributes as $imgattribute)
                {
                    if ($imgattribute->nodeName == 'class' && $imgattribute->nodeValue == 'card-img-top')
                        $esperfil = true;
                    if ($imgattribute->nodeName == 'src' && $esperfil)
                        $fotoperfil = 'https://www.congreso.es/' . $imgattribute->nodeValue;
                }
            }

            $divs = $doc->getElementsByTagName ('div');

            foreach ($divs as $div)
            {
                foreach ($div->attributes as $attribute)
                {
                    if ($attribute->nodeName == 'class')
                    {
                        if ($attribute->nodeValue == 'ico-escanyo')
                        {
                            foreach ($div->childNodes as $child)
                                if ($child->nodeName == 'img')
                                    foreach ($child->attributes as $childatt)
                                        if ($childatt->nodeName == 'src')
                                            $fotoescanio = 'https://www.congreso.es/' . $childatt->nodeValue;
                        }
                        if ($attribute->nodeValue == 'nombre-dip')
                            $nombrecompleto = trim($div->firstChild->nodeValue);
                        if ($attribute->nodeValue == 'email-dip')
                        {
                            foreach ($div->childNodes as $child)
                            {
                                if ($child->nodeName == 'a')
                                    $email = $child->firstChild->data;
                            }
                        }
                        if ($attribute->nodeValue == 'rrss-dip')
                        {
                            $rs_name = '';
                            $rs_url = '';

                            foreach ($div->childNodes as $child)
                            {
                                if ($child->nodeName == 'a')
                                {
                                    foreach ($child->childNodes as $childnode)
                                        if ($childnode->nodeName == 'img')
                                            foreach ($childnode->attributes as $rrsschildatt)
                                                if ($rrsschildatt->nodeName == 'alt')
                                                    $rs_name = $rrsschildatt->nodeValue;

                                    foreach ($child->attributes as $attribute2)
                                    {
                                        if ($attribute2->nodeName == 'href')
                                        {
                                            $rs_url = $attribute2->nodeValue;
                                            if ($rs_name != '')
                                                $rrss[$rs_name] = $rs_url;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($nombrecompleto != '')
            {
                $dipu_imp = DiputadoImportado::findOrCreate ($nombrecompleto);
                $dipu = Diputado::findOrCreate ($nombrecompleto);

                $dipu_imp->numero = $i;
                $dipu_imp->urlperfil = $ruta;
                $dipu_imp->urlfoto = $fotoperfil;
                $dipu_imp->urlescaño = $fotoescanio;
                $dipu_imp->email = $email;
                $dipu_imp->twitter = FormaterUtils::JSONValueOrEmpty ($rrss, 'twitter');
                $dipu_imp->facebook = FormaterUtils::JSONValueOrEmpty ($rrss, 'facebook');
                $dipu_imp->instagram = FormaterUtils::JSONValueOrEmpty ($rrss, 'instagram');
                $dipu_imp->youtube = FormaterUtils::JSONValueOrEmpty ($rrss, 'youtube');
                $dipu_imp->webpersonal =  FormaterUtils::JSONValueOrEmpty ($rrss, 'personal-web');
                $dipu_imp->save();


                $dipu->numero = $dipu_imp->numero;
                $dipu->urlperfil = $dipu_imp->urlperfil;
                $dipu->urlfoto = $dipu_imp->urlfoto;
                $dipu->urlescaño = $dipu_imp->urlescaño;
                $dipu->email = $dipu_imp->email;
                $dipu->twitter = $dipu_imp->twitter;
                $dipu->facebook = $dipu_imp->facebook;
                $dipu->instagram = $dipu_imp->instagram;
                $dipu->youtube = $dipu_imp->youtube;
                $dipu->webpersonal = $dipu_imp->webpersonal;
                $dipu->save();
            }
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Cargamos los valores por defecto de Sexo y Estado Civil si están vacíos
        Sexo::inicializar();
        EstadoCivil::inicializar();
        dump ('Importando diputados JSON');
        $this->importar_diputados();
        dump ('Importando diputados HTML');
        $this->importar_diputados_html();
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        if (isset($this->avance))
            $this->avance->finalizar();
        dump ("Proceso terminado por excepción");
    }
}
