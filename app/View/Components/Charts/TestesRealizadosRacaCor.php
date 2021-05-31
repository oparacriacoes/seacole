<?php

namespace App\View\Components\Charts;

use App\Enums\LocaisInternacaoEnum;
use App\Enums\TestesRealizados;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class TestesRealizadosRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.testes-realizados-raca-cor';

    public function chartData(): array
    {
        $collection = collect();
        $testes = TestesRealizados::readables();

        foreach ($testes as $key => $value) {
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    $value,
                    strtolower('%' . $key . '%')
                ]
            ));
        }

        $colletionToChartDataset = new CollectionToChartDatasets(
            'teste_utilizado',
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
            teste_utilizado
        from
            (
            select
                count(p.id) as total,
                cor_raca,
                CASE
                WHEN teste_utilizado is not null THEN ?
                END AS teste_utilizado
            from
                pacientes p
            where
                cor_raca is not null
                and teste_utilizado is not null
                and LOWER(teste_utilizado) LIKE ?
            group by
                cor_raca,
                teste_utilizado
            order by
                teste_utilizado,
                cor_raca
            ) as tb
        group by
            cor_raca,
            teste_utilizado
        order by
            teste_utilizado,
            cor_raca;
            ";
}
