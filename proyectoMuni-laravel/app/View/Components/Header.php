<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\ConfiguracionSitio;
use App\Municipio;
use Illuminate\Support\Facades\DB;

class Header extends Component
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
        $paginas = DB::table('paginas')->orderBy('index','ASC')->select('titulo_menu','id','index','slug')->get();
        $muni = Municipio::get()->first();
        $personajes = DB::table('personajes')->select('id', 'nombre', 'slug')->orderBy('index','asc')->get();
        $tipos_autoridades = DB::table('autoridads')
                    ->join('tipo_autoridads', 'autoridads.tipo_autoridad', 'tipo_autoridads.id')
                    ->select('tipo_autoridads.*')
                    ->orderBy('tipo_autoridads.index', 'asc')
                    ->get();

        $direcciones = DB::table('direccion_municipals')->select('id', 'nombre', 'slug')->orderBy('index','asc')->get();

        return view('components.header', compact('muni','paginas', 'personajes', 'tipos_autoridades', 'direcciones'));
    }
}
