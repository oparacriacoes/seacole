<?php

namespace App\View\Components\Charts;

use App\Paciente;

class CasosMonitoradoCidade extends ChartComponent
{
    protected string $componentView = 'components.charts.casos-monitorado-cidade';

    public function chartData(): array
    {
        $collection = Paciente::selectRaw('endereco_cidade, count(id) as total')
            ->groupBy('endereco_cidade')
            ->orderBy('total', 'desc')
            ->get();

        $collection->transform(function ($item, $key) {
            if (is_null($item['endereco_cidade'])) {
                $item['endereco_cidade'] = 'Sem informação';
            }
            return $item;
        });

        return [
            'labels' => $collection->pluck('endereco_cidade'),
            'data' => $collection->pluck('total'),
        ];
    }
}
