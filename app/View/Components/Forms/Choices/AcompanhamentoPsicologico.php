<?php

namespace App\View\Components\Forms\Choices;

use App\Enums\AcompanhamentoPsicologico as EnumsAcompanhamentoPsicologico;
use Illuminate\View\Component;

class AcompanhamentoPsicologico extends Component
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
        return view('components.forms.choices.acompanhamento-psicologico')
            ->with(['acompanhamentos_psicologico' => EnumsAcompanhamentoPsicologico::readables()]);
    }
}
