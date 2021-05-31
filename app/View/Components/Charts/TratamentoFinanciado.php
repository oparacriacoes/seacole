<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class TratamentoFinanciado extends ChartComponent
{
    protected string $componentView = 'components.charts.tratamento-financiado';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query_1));
        $collection = $collection->merge(DB::select($this->query_2));

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
            count(id) as total,
            cor_raca,
            tratamento_financiado as info
        from
            (
            select
                p.id,
                CASE
                WHEN cor_raca is null THEN 'Sem Informação'
                ELSE cor_raca
                END as cor_raca,
                CASE
                WHEN io.tratamento_financiado like '%PICS%' THEN 'PICS - Sim'
                ELSE 'PICS - Não'
                END AS tratamento_financiado
            from
                pacientes p
                inner join insumos_oferecidos io on io.paciente_id = p.id
            order by
                tratamento_financiado desc,
                cor_raca
            ) as tb
        group by
            cor_raca,
            info
        order by
            info desc,
            cor_raca;
    ";

    private $query_2 = "
        select
            count(id) as total,
            cor_raca,
            tratamento_financiado as info
        from
            (
            select
                p.id,
                CASE
                WHEN cor_raca is null THEN 'Sem Informação'
                ELSE cor_raca
                END as cor_raca,
                CASE
                WHEN io.tratamento_financiado like '%alop%' THEN 'Alopáticos - Sim'
                ELSE 'Alopáticos - Não'
                END AS tratamento_financiado
            from
                pacientes p
                inner join insumos_oferecidos io on io.paciente_id = p.id
            order by
                tratamento_financiado desc,
                cor_raca
            ) as tb
        group by
            cor_raca,
            info
        order by
            info desc,
            cor_raca;
    ";
}
