<?php

namespace App\View\Components\Forms\Choices;

use App\Enums\Semana;
use Illuminate\View\Component;

class DiaSemana extends Component
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
        $semana = Semana::readables();

        return view('components.forms.choices.dia-semana')->with(['semana' => $semana]);
    }
}
