<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class UsoDrogasAlcool extends ChartComponent
{
    protected string $componentView = 'components.charts.uso-drogas-alcool';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query_1));
        $collection = $collection->merge(collect(DB::select($this->query_2)));

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
            WHEN cronico_alcool is true THEN 'Alcoolismo - Sim'
            WHEN cronico_alcool is false THEN 'Alcoolismo - Não'
            ELSE 'Sem Informação'
            END AS info
        from
            pacientes p
        where cronico_alcool is not null
        group by
            cor_raca,
            cronico_alcool
        order by
            cronico_alcool desc,
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
            WHEN outras_drogas is true THEN 'Uso crônico drogas - Sim'
            WHEN outras_drogas is false THEN 'Uso crônico drogas - Não'
            ELSE 'Sem Informação'
            END AS info
        from
            pacientes p
        where outras_drogas is not null
        group by
            cor_raca,
            outras_drogas
        order by
            outras_drogas desc,
            cor_raca;
        ";
}
