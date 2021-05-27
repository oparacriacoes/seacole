<?php

namespace App\View\Components\Charts;

use App\Enums\LocaisInternacaoEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class LocalInternacaoRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.local-internacao-raca-cor';

    public function chartData(): array
    {
        $collection = collect();
        $locais_internacao = LocaisInternacaoEnum::readables();

        foreach ($locais_internacao as $local_internacao) {
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    $local_internacao,
                    strtolower('%' . $local_internacao . '%')
                ]
            ));
        }

        $colletionToChartDataset = new CollectionToChartDatasets(
            'local_internacao',
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
            cor_raca,
            local_internacao as locais_internacao,
            CASE WHEN local_internacao is not null THEN ? END AS local_internacao
        from
            pacientes p
            LEFT JOIN servico_internacaos si ON p.id = si.paciente_id
        where
            cor_raca is not null
            and local_internacao is not null
            and LOWER(local_internacao) LIKE ?
        group by
            cor_raca,
            local_internacao
        order by
            local_internacao,
            cor_raca;
            ";
}
