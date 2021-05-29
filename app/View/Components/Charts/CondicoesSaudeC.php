<?php

namespace App\View\Components\Charts;

use App\Enums\DoencasCronicasEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class CondicoesSaudeC extends ChartComponent
{
    protected string $componentView = 'components.charts.condicoes-saude-c';

    public function chartData(): array
    {
        $collection = collect();
        $doencas_cronicas = array_slice(DoencasCronicasEnum::readables(), 8, 4, true);

        foreach ($doencas_cronicas as $key => $value) {
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    $value,
                    strtolower('%"' . $key . '"%')
                ]
            ));
        }

        $colletionToChartDataset = new CollectionToChartDatasets(
            'doenca_cronica',
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
            doenca_cronica
        from
            (
            select
                count(p.id) as total,
                cor_raca,
                CASE
                WHEN doenca_cronica is not null THEN ?
                END AS doenca_cronica
            from
                pacientes p
            where
                cor_raca is not null
                and doenca_cronica LIKE ?
            group by
                cor_raca,
                doenca_cronica
            order by
                doenca_cronica,
                cor_raca
            ) as tb
        group by
            cor_raca,
            doenca_cronica
        order by
            doenca_cronica,
            cor_raca;
        ";
}
