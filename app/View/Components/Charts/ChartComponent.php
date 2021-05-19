<?php

namespace App\View\Components\Charts;

use Illuminate\View\Component;

abstract class ChartComponent extends Component
{
    public ?string $date_from;
    public ?string $date_to;

    public function __construct(?string $datefrom, ?string $dateto)
    {
        $this->date_from = $datefrom;
        $this->date_to = $dateto;
    }

    abstract public function chartData(): array;
}
