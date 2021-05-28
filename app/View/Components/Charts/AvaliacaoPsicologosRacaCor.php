<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class AvaliacaoPsicologosRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.avaliacao-psicologos-raca-cor';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));
        $colletionToChartDataset = new CollectionToChartDatasets(
            'acompanhamento_psicologo',
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
            count(id) as total,
            CASE
                WHEN psicologo_id is null then 'Não'
                ELSE 'Sim'
            END as acompanhamento_psicologo,
            CASE
                WHEN cor_raca is null then 'Sem Informação'
                ELSE cor_raca
            END as cor_raca
        from
            pacientes
        group by
            cor_raca,
            acompanhamento_psicologo
        order by
            acompanhamento_psicologo,
            cor_raca desc;
    ";
}
