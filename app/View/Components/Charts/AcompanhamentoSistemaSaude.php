<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class AcompanhamentoSistemaSaude extends ChartComponent
{
    protected string $componentView = 'components.charts.acompanhamento-sistema-saude';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        $colletionToChartDataset = new CollectionToChartDatasets(
            'info',
            'cor_raca',
            'total',
            $collection
        );

        return [
            'labels' => array_values(array_unique(join_colors_to_black($collection))),
            'sublabels' => $colletionToChartDataset->getLabels(),
            'datasets' => stack_black_colors($colletionToChartDataset->getDatasets())
        ];
    }

    private $query = "
        select
            count(p.id) as total,
            CASE
                WHEN cor_raca is null THEN 'Sem Informação'
                ELSE cor_raca
            END as cor_raca,
            CASE
                WHEN acompanhamento_ubs is true THEN 'Sim'
                WHEN acompanhamento_ubs is false THEN 'Não'
                ELSE 'Sem Informação'
            END AS info
        from
            pacientes p
        where
            acompanhamento_ubs is not null
        group by
            cor_raca,
            acompanhamento_ubs
        order by
            acompanhamento_ubs desc,
            cor_raca;
        ";
}
