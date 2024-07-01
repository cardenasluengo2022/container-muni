<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;


class Destacados extends Component
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
        $config = DB::table('configuracion_sitios')->first();
        $configP = DB::table('pagina_principals')->first();
        $tipos = DB::table('tipo_comunicados')->get();
        $muni = DB::table('municipios')->first();

        if ($tipos != null && count($tipos) > 0) {
            foreach ($tipos as $t) {
                $t->ancho = "false";
                $t->comunicados = DB::table('comunicados')
                                        ->where('tipo_comunicado', $t->id)
                                        ->orderBy('fecha_inicio', 'asc')
                                        ->orderBy('hora_inicio', 'asc')
                                        ->get();
                if ($t->tipo == "Aviso") {
                    $t->ancho = DB::table("pagina_principals")->select("destacados_aviso")->first();
                } elseif ($t->tipo == "Evento") {
                    $t->ancho = DB::table("pagina_principals")->select("destacados_evento")->first();
                } elseif($t->tipo == "Utilidad Pública"){
                    $t->ancho = DB::table("pagina_principals")->select("destacados_utilidad")->first();
                }
                
            }
        }
        

        return view('components.destacados', compact('tipos', 'config', 'configP', 'muni'));
    }
}
