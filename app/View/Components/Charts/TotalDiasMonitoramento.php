<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class TotalDiasMonitoramento extends ChartComponent
{
    protected string $componentView = 'components.charts.total-dias-monitoramento';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        $colletionToChartDataset = new CollectionToChartDatasets(
            'intervalo',
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
            cor_raca,
            CASE
                WHEN dias > 0 and dias <= 5 THEN '0 a 5'
                WHEN dias > 5 and dias <= 10 THEN '6 a 10'
                WHEN dias > 10 and dias <= 15 THEN '11 a 15'
                WHEN dias > 15 and dias <= 20 THEN '16 a 20'
                WHEN dias > 20 and dias <= 30 THEN '21 a 30'
                WHEN dias > 30 THEN '30 e mais'
            END AS intervalo,
            CASE
                WHEN dias > 0 and dias <= 5 THEN 1
                WHEN dias > 5 and dias <= 10 THEN 2
                WHEN dias > 10 and dias <= 15 THEN 3
                WHEN dias > 15 and dias <= 20 THEN 4
                WHEN dias > 20 and dias <= 30 THEN 5
                WHEN dias > 30 THEN 6
            END AS sequence
        from
            (
            select
                id,
                cor_raca,
                DATEDIFF(data_finalizacao_caso, data_inicio_monitoramento) AS dias
            from
                pacientes
            where
                data_finalizacao_caso is not null
                and data_inicio_monitoramento is not null
                and cor_raca is not null
            order by
                DATEDIFF(data_finalizacao_caso, data_inicio_monitoramento)
            ) as tb
        where dias > 0
        group by
            cor_raca,
            intervalo,
            sequence
        order by
            sequence,
            cor_raca;
        ";
}
