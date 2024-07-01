<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\ConfiguracionSitio;
use App\Municipio;
use Phim\Color\Scheme\NamedMonochromaticScheme;
use Phim\Color;

class ColorStyleComponent extends Component
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
        $muni = Municipio::first();
        $config = ConfiguracionSitio::get()->first();

        if($config != null && isset($config->color_principal)){
            //$colorP = 'e96b56';
            $colores = new NamedMonochromaticScheme($config->color_principal, .3);

            $config->color_1 = $colores->getDarkestShade();
            $config->color_2 = $colores->getDarkShade();
            $config->color_base = $colores->getBaseColor();
            $config->color_3 = $colores->getLightTint();
            $config->color_4 = $colores->getLighterTint();
            $config->color_5 = $colores->getLightestTint();
        }
        return view('components.color-style-component', compact('config', 'muni'));
    }
}
