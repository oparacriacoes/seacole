<?php

namespace App\View\Components\Forms\Choices;

use App\Models\Vacina;
use Illuminate\View\Component;

class Vacinas extends Component
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
        $vacinas = Vacina::whereIsActive(1)->get();

        return view('components.forms.choices.vacinas')
            ->with(['vacinas' => $vacinas]);
    }
}
