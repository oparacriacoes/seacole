<?php

namespace App\View\Components\Charts;

use App\Enums\AcessosSistemaSaudeEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class AcessoSistemaSaude extends ChartComponent
{
    protected string $componentView = 'components.charts.acesso-sistema-saude';

    public function chartData(): array
    {
        $collection = collect();
        $sistemas_saude = AcessosSistemaSaudeEnum::readables();

        foreach ($sistemas_saude as $key => $value) {
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    $value,
                    strtolower('%' . $key . '%')
                ]
            ));
        }

        $colletionToChartDataset = new CollectionToChartDatasets(
            'sistema_saude',
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
            sistema_saude
        from
            (
            select
                count(p.id) as total,
                cor_raca,
                CASE
                    WHEN sistema_saude is not null THEN ?
                END AS sistema_saude
            from
                pacientes p
            where
                cor_raca is not null
                and sistema_saude is not null
                and LOWER(sistema_saude) LIKE ?
            group by
                cor_raca,
                sistema_saude
            order by
                sistema_saude,
                cor_raca
            ) tb
        group by
            cor_raca,
            sistema_saude;
    ";
}
