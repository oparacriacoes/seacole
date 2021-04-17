<?php

namespace App\View\Components\Forms\Choices;

use App\Enums\ServicosSaudeEnum;
use Illuminate\View\Component;

class ServicoSaude extends Component
{
    public $value;
    public $property;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value, $property)
    {
        $this->value = $value;
        $this->property = $property;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.choices.servico-saude')
            ->with(['servicos_saude' => ServicosSaudeEnum::readables()]);
    }
}
