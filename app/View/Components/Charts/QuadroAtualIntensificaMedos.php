<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class QuadroAtualIntensificaMedos extends ChartComponent
{
    protected string $componentView = 'components.charts.quadro-atual-intensifica-medos';

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
                WHEN quadro_atual is true THEN 'Sim'
                WHEN quadro_atual is false THEN 'Não'
                ELSE 'Sem Informação'
            END AS info
        from
            pacientes p
            inner join saude_mentals sm on sm.paciente_id = p.id
        where
            quadro_atual is not null
        group by
            cor_raca,
            quadro_atual
        order by
            quadro_atual desc,
            cor_raca;
        ";
}
