<?php

namespace App\View\Components\Forms\Choices;

use App\Enums\OrientacoesSexuais;
use Illuminate\View\Component;

class OrientacaoSexual extends Component
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
        return view('components.forms.choices.orientacao-sexual')
            ->with(['orientacoes_sexuais' => OrientacoesSexuais::readables()]);
    }
}
