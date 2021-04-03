<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputCheck extends Component
{
    public $value;
    public $property;
    public $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value, $property, $model)
    {
        $this->value = $value;
        $this->property = $property;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $isChecked = $this->model->getAttribute($this->property) == $this->value;

        return view('components.forms.input-check', [
            'checked' => $isChecked
        ]);
    }
}
