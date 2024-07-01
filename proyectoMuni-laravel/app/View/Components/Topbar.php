<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\ConfiguracionSitio;
use App\Municipio;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use Phim\Color\Scheme\NamedMonochromaticScheme;
use Phim\Color;

class Topbar extends Component
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
        $muni = Municipio::first();

        $rrss = DB::table('redsocial_municipios')
                ->join('redsocials', 'redsocial_municipios.redsocial', '=', 'redsocials.id')
                ->join('municipios', 'redsocial_municipios.municipio', '=', 'municipios.id')
                ->where('municipios.id', $muni->id)
                ->select('redsocial_municipios.*', 'redsocials.nombre', 'redsocials.icono', 'redsocials.url_base')
                ->get();

        $configTopBar = DB::table('pagina_principals')
                            ->select('header_chek',
                                    'rrss_header',
                                    'datos_header',
                                    'color_header',
                                    'altura_header')
                            ->first();
        $configTopBar->style = "";
        $datos = [];
        $configTopBar->colorFont = "#bababa";

        if($configTopBar != null){
           
            if($configTopBar->color_header != null){
                $configTopBar->style .= "background: ".$configTopBar->color_header.";";
                $rgba =  Color::get($configTopBar->color_header);
                
                if( ($rgba->getRed()*0.299)+($rgba->getGreen()*0.587)+($rgba->getBlue()*0.114) > 186) {
                    $configTopBar->colorFont = '#17202A';
                  } else {
                    $configTopBar->colorFont = '#EAECEE';
                  }

            }
            if($configTopBar->altura_header != null){
                $configTopBar->style .= "height: ".$configTopBar->altura_header."px;";
            }

            $datos_header = json_decode($configTopBar->datos_header);
            if(count($datos_header) > 0){
                foreach($datos_header as $dh){
                    if($dh == "nombre"){
                        $datos['nombre'] = "bi-building";
                    }
                    if($dh == "direccion"){
                        $datos['direccion'] = "bi-pin-map";
                    }
                    if($dh == "email"){
                        $datos['email'] = "bi-envelope";
                    }
                    if($dh == "fono1"){
                        $datos['fono1'] = "bi-telephone";
                    }
                    if($dh == "fono2"){
                        $datos['fono2'] = "bi-telephone";
                    }
                }
            }  

            $configTopBar->datos = $datos;
        }

        


        return view('components.topbar', compact('config', 'muni', 'rrss', 'configTopBar'));
    }
}
