<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarComplete extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tipo;
    public function __construct($tipo)
    {
        $this->tipo=$tipo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $tipo = $this->tipo;
        return view('components.sidebar-complete', compact('tipo'));
    }
}
