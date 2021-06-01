<?php

namespace App\View\Components\Charts;

use App\Enums\SequelasEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class SequelasCorRaca extends ChartComponent
{
    protected string $componentView = 'components.charts.sequelas-cor-raca';

    public function chartData(): array
    {
        $collection = collect();
        $filters = SequelasEnum::readables();

        foreach ($filters as $key => $value) {
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    $value,
                    strtolower('%' . $key . '%')
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
            sequela
        from
            (
            select
                count(p.id) as total,
                cor_raca,
                sequelas,
                CASE
                WHEN sequelas is not null THEN ?
                END AS sequela
            from
                pacientes p
                LEFT JOIN quadro_atual qa ON p.id = qa.paciente_id
            where
                cor_raca is not null
                and LOWER(sequelas) LIKE ?
            group by
                cor_raca,
                sequelas
            order by
                sequelas,
                cor_raca
            ) tb
        group by
            cor_raca,
            sequela
        order by
            sequela,
            cor_raca;
    ";
}
