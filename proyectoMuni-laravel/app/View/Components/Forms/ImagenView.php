<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ImagenView extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $lista = $this->data;
        return view('components.forms.imagen-view', compact('lista'));
    }
}
