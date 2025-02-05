<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class GestacaoAltoRisco extends ChartComponent
{
    protected string $componentView = 'components.charts.gestacao-alto-risco';

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
                WHEN gestacao_alto_risco is true THEN 'Sim'
                WHEN gestacao_alto_risco is false THEN 'Não'
                ELSE 'Sem Informação'
            END AS info
        from
            pacientes p
        where gestacao_alto_risco is not null
        group by
            cor_raca,
            gestacao_alto_risco
        order by
            gestacao_alto_risco desc,
            cor_raca;
        ";
}
