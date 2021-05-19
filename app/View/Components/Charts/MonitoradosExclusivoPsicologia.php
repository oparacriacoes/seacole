<?php

namespace App\View\Components\Charts;


class MonitoradosExclusivoPsicologia extends ChartComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function chartData(): array
    {
        return [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.charts.monitorados-exclusivo-psicologia');
    }
}
