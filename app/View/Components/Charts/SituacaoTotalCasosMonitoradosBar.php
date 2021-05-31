<?php

namespace App\View\Components\Charts;

use App\Enums\SituacoesCaso;
use App\Models\Paciente;

class SituacaoTotalCasosMonitoradosBar extends ChartComponent
{
    protected string $componentView = 'components.charts.situacao-total-casos-monitorados-bar';

    public function chartData(): array
    {
        $collection = Paciente::selectRaw('situacao, count(id) as total')
            ->groupBy('situacao')
            ->orderBy('total', 'desc')
            ->get();

        $collection->transform(function ($item, $key) {
            if (is_null($item['situacao'])) {
                $item['situacao'] = 'Sem informação';
            } else {
                $item['situacao'] = (string)SituacoesCaso::get(intval($item['situacao']));
            }
            return $item;
        });

        return [
            'labels' => $collection->pluck('situacao'),
            'data' => $collection->pluck('total'),
        ];
    }
}
