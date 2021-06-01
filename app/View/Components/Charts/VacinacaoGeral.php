<?php

namespace App\View\Components\Charts;

use App\Models\Paciente;
use App\Models\Vacinacao;

class VacinacaoGeral extends ChartComponent
{
    protected string $componentView = 'components.charts.vacinacao-geral';

    public function chartData(): array
    {
        $collection = Vacinacao::selectRaw("DATE_FORMAT(data_vacinacao, '%Y-%m') date, count(id) total")
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->whereRaw("data_vacinacao is not null")
            ->whereBetween('data_vacinacao', [$this->date_from, $this->date_to])
            ->get();

        return [
            'labels' => $collection->pluck('date'),
            'data' => $collection->pluck('total'),
        ];
    }
}
