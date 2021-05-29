<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class TrismesteGestacaoRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.trismeste-gestacao-raca-cor';

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
            trimestre_gestacao as info
        from
            pacientes p
        where
            trimestre_gestacao is not null
        group by
            cor_raca,
            trimestre_gestacao
        order by
            trimestre_gestacao desc,
            cor_raca;
        ";
}
