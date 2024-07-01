<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use App\ConfiguracionSitio;
use App\PaginaPrincipal;
use App\Municipio;
use \stdClass;

class SeccionSegundaria extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $config = ConfiguracionSitio::first();
        $paginaPrincipal = PaginaPrincipal::first();
        $muni = Municipio::first();


        $arreglo = [];
        $portadas2 = [];

        if ($paginaPrincipal->segundaria_chek == 1) {

            if (isset($paginaPrincipal->segundaria_contenido) && $paginaPrincipal->segundaria_contenido != "") {
                $limpio = str_replace(['"', '[', ']'], '', json_decode($paginaPrincipal->segundaria_contenido, true));
                $limpio = explode(',', $limpio);
                $arreglo = $limpio;
            }
    
            if (count($arreglo) > 0) {
                foreach ($arreglo as $a) {
                    $contenido = explode('|', $a);
                    if ($contenido[0] == 'noticias') {
                        $noticia = DB::table('noticias')
                                    ->where('visible', 1)
                                    ->whereNull('deleted_at')
                                    ->where('slug', $contenido[1])
                                    ->select('id', 'slug', 'titular', 'intro', 'imagen','redaccion')
                                    ->first();
                        if ($noticia != null) {
                            $portada = new stdClass();
                            $portada->titular = $noticia->titular;
                            $portada->subtitulo = $noticia->intro;
                            $portada->texto = $noticia->redaccion;
                            $portada->slug = "/noticias/".$noticia->slug;
                            $imagenes = json_decode($noticia->imagen, true);
                            $portada->imagen = $imagenes[0];
                            array_push($portadas2, $portada);
                        }
                    }else if ($contenido[0] == 'paginas') {
                        $pagina = DB::table('paginas')
                                    ->whereNull('deleted_at')
                                    ->where('slug', $contenido[1])
                                    ->select('id', 'slug', 'titulo_menu', 'titulo', 'imagenes', 'texto')
                                    ->first();
                        if ($pagina != null) {
                            $portada = new stdClass();
                            $portada->titular = $pagina->titulo_menu;
                            $portada->subtitulo = $pagina->titulo;
                            $portada->texto = $pagina->texto;
                            $portada->slug = "/paginas/".$pagina->slug;
                            $imagenes = json_decode($pagina->imagenes, true);
                            $portada->imagen = $imagenes[0];
                            array_push($portadas2, $portada);
                        }
                    }
                }
            }
            
        } 

        return view('components.seccion-segundaria', compact('paginaPrincipal', 'muni', 'config', 'portadas2'));
    }
}
