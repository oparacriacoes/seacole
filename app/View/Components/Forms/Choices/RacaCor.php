<?php

namespace App\View\Components\Forms\Choices;

use App\Enums\RacasCores;
use Illuminate\View\Component;

class RacaCor extends Component
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
        return view('components.forms.choices.raca-cor')
            ->with(['racas_cores' => RacasCores::readables()]);
    }
}
