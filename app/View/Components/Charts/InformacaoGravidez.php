<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class InformacaoGravidez extends ChartComponent
{
    protected string $componentView = 'components.charts.informacao-gravidez';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query_1));
        $collection = $collection->merge(collect(DB::select($this->query_2)));
        $collection = $collection->merge(collect(DB::select($this->query_3)));

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

    private $query_1 = "
        select
            count(p.id) as total,
            CASE
                WHEN cor_raca is null THEN 'Sem Informação'
                ELSE cor_raca
            END as cor_raca,
            CASE
                WHEN gestante is true THEN 'Gestante - Sim'
                WHEN gestante is false THEN 'Gestante - Não'
                ELSE 'Sem Informação'
            END AS info
        from
            pacientes p
        where gestante is not null
        group by
            cor_raca,
            gestante
        order by
            gestante desc,
            cor_raca;
        ";

    private $query_2 = "
        select
            count(p.id) as total,
            CASE
                WHEN cor_raca is null THEN 'Sem Informação'
                ELSE cor_raca
                END as cor_raca,
            CASE
                WHEN amamenta is true THEN 'Amamenta - Sim'
                WHEN amamenta is false THEN 'Amamenta - Não'
                ELSE 'Sem Informação'
            END AS info
        from
            pacientes p
        where amamenta is not null
        group by
            cor_raca,
            amamenta
        order by
            amamenta desc,
            cor_raca;
        ";

    private $query_3 = "
        select
            count(p.id) as total,
            CASE
                WHEN cor_raca is null THEN 'Sem Informação'
                ELSE cor_raca
                END as cor_raca,
            CASE
                WHEN pos_parto is true THEN 'Pós Parto - Sim'
                WHEN pos_parto is false THEN 'Pós Parto - Não'
                ELSE 'Sem Informação'
            END AS info
        from
            pacientes p
        where pos_parto is not null
        group by
            cor_raca,
            pos_parto
        order by
        pos_parto desc,
            cor_raca;
    ";
}
