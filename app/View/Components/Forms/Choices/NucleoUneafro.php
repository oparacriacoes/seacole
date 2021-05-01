<?php

namespace App\View\Components\Forms\Choices;

use App\Enums\NucleosUneafro;
use Illuminate\View\Component;

class NucleoUneafro extends Component
{
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.choices.nucleo-uneafro')
            ->with(['nucleos_uneafro' => NucleosUneafro::readables()]);
    }
}
