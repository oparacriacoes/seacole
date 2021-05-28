<?php

namespace App\View\Components\Charts;

use App\Enums\DesfechosEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class DesfechosCorRaca extends ChartComponent
{
    protected string $componentView = 'components.charts.desfechos-cor-raca';

    public function chartData(): array
    {
        $collection = collect();
        $sequelas = DesfechosEnum::values();

        foreach ($sequelas as $sequela) {
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    $sequela,
                    strtolower('%' . $sequela . '%')
                ]
            ));
        }

        $colletionToChartDataset = new CollectionToChartDatasets(
            'sequela',
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
            sum(total) as total,
            cor_raca,
            desfecho
        from
            (
            select
                count(p.id) as total,
                cor_raca,
                desfecho as desfechos,
                CASE
                WHEN desfecho is not null THEN ?
                END AS desfecho
            from
                pacientes p
                LEFT JOIN quadro_atual qa ON p.id = qa.paciente_id
            where
                cor_raca is not null
                and situacao NOT IN (5, 14)
                and LOWER(desfecho) LIKE ?
            group by
                cor_raca,
                desfecho
            order by
                desfecho,
                cor_raca
            ) tb
        group by
            cor_raca,
            desfecho
        order by
            desfecho,
            cor_raca;
    ";
}