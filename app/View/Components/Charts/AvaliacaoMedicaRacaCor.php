<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class AvaliacaoMedicaRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.avaliacao-medica-raca-cor';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));
        $colletionToChartDataset = new CollectionToChartDatasets(
            'acompanhamento_medico',
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
                WHEN acompanhamento_medico is null then null
                WHEN acompanhamento_medico is true then 'Sim'
                WHEN acompanhamento_medico is false then 'Não'
                ELSE acompanhamento_medico
            END as acompanhamento_medico,
            CASE
                WHEN cor_raca is null then 'Sem Informação'
                ELSE cor_raca
            END as cor_raca
        from
            pacientes
        group by
            cor_raca,
            acompanhamento_medico
        order by
            acompanhamento_medico,
            cor_raca desc;
    ";
}
