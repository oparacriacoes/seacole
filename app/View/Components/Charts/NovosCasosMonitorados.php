<?php

namespace App\View\Components\Charts;

use App\Paciente;
use Illuminate\View\Component;

class NovosCasosMonitorados extends Component
{

    public ?string $date_from;
    public ?string $date_to;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $datefrom, ?string $dateto)
    {
        $this->date_from = $datefrom;
        $this->date_to = $dateto;
    }

    public function chartData()
    {
        $collection = Paciente::selectRaw("DATE_FORMAT(coalesce(least(data_inicio_monitoramento, data_inicio_ac_psicologico), data_inicio_monitoramento, data_inicio_ac_psicologico), '%Y-%m') date, count(id) total")
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->whereRaw("coalesce(least(data_inicio_monitoramento, data_inicio_ac_psicologico), data_inicio_monitoramento, data_inicio_ac_psicologico) is not null")
            ->whereBetween('created_at', [$this->date_from, $this->date_to])
            ->get();

        return [
            'labels' => $collection->pluck('date'),
            'data' => $collection->pluck('total'),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.charts.novos-casos-monitorados')->with(['chart_data' => $this->chartData()]);
    }
}
