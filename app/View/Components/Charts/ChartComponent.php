<?php

namespace App\View\Components\Charts;

use Carbon\Carbon;
use Illuminate\View\Component;

abstract class ChartComponent extends Component
{
    public \DateTimeInterface $date_from;
    public \DateTimeInterface $date_to;

    public function __construct(string $datefrom, string $dateto)
    {
        $this->date_from = Carbon::parse($datefrom);
        $this->date_to = Carbon::parse($dateto);
    }

    abstract public function chartData(): array;
}
