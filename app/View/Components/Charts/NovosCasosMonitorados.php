<?php

namespace App\View\Components\Charts;

use App\Paciente;

class NovosCasosMonitorados extends ChartComponent
{
    public function chartData(): array
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
