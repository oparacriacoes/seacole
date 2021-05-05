<?php

namespace App\View\Components\Charts;

use Carbon\Carbon;
use Illuminate\View\Component;

abstract class ChartComponent extends Component
{
    public \DateTimeInterface $date_from;
    public \DateTimeInterface $date_to;
    protected string $componentView;

    public function __construct(string $datefrom, string $dateto)
    {
        $this->date_from = Carbon::parse($datefrom);
        $this->date_to = Carbon::parse($dateto);
    }

    abstract public function chartData(): array;

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view($this->componentView)->with(['chart_data' => $this->chartData()]);
    }
}
