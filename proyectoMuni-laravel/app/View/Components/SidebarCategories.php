<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class SidebarCategories extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tipo;
    public $direccion;

    public function __construct($tipo, $direccion = 0)
    {
        $this->tipo = $tipo;
        $this->direccion = $direccion;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $paginas = DB::table('paginas')->orderBy('index','ASC')->select('titulo_menu','id','index','slug')->get();
        $personajes = DB::table('personajes')->select('id', 'nombre', 'slug')->orderBy('index','asc')->get();
        $tipoAutoridades = DB::table('autoridads')
                    ->join('tipo_autoridads', 'autoridads.tipo_autoridad', 'tipo_autoridads.id')
                    ->select('tipo_autoridads.*')
                    ->orderBy('tipo_autoridads.index', 'asc')
                    ->get();
        $direcciones = DB::table('direccion_municipals')->whereNull('deleted_at')->orderBy('index', 'asc')->get();
        $concejales = DB::table('concejales')->whereNull('deleted_at')->orderBy('index', 'asc')->get();
        $tramites = [];
        $categoriasEmprendimiento = DB::table('categoria_emprendimientos')
                                            ->orderBy('index', 'asc')
                                            ->whereNull('deleted_at')
                                            ->get();

        if ($this->direccion != 0) {
            $tramites = DB::table('tramites')
                                ->whereNull('deleted_at')
                                ->where('direccion_municipal', $this->direccion)
                                ->orderBy('index', 'asc')
                                ->get();
        }
        
        
        return view('components.sidebar-categories', compact('paginas', 
                                                             'personajes', 
                                                             'tipoAutoridades', 
                                                             'direcciones', 
                                                             'concejales',
                                                             'tramites',
                                                             'categoriasEmprendimiento'));
    }
}
