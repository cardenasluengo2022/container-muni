<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class FooterTopComponent extends Component
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
        $direcciones = DB::table('direccion_municipals')
                                ->select('id', 'nombre', 'slug')
                                ->orderBy('index')
                                ->whereNull('deleted_at')
                                ->get();
        $muni = DB::table('municipios')->first();
        $ciudad = DB::table('ciudads')->where('id', $muni->ciudad)->first();
        $rrss = DB::table('redsocial_municipios')
                ->join('redsocials', 'redsocial_municipios.redsocial', '=', 'redsocials.id')
                ->join('municipios', 'redsocial_municipios.municipio', '=', 'municipios.id')
                ->where('municipios.id', $muni->id)
                ->select('redsocial_municipios.*', 'redsocials.nombre', 'redsocials.icono', 'redsocials.url_base')
                ->get();
        $tramitesOnline = DB::table('tramites')
                                ->select('id', 'nombre', 'slug', 'index')
                                ->whereNotNull('url')
                                ->whereNull('deleted_at')
                                ->orderBy('index')
                                ->get();

        return view('components.footer-top-component', compact('direcciones', 'muni', 'ciudad', 'rrss', 'tramitesOnline'));
    }
}
