<?php

namespace App\View\Components\Charts;

use App\Enums\MedicacoesTratamentoCovidEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class MedicacoesCovid19 extends ChartComponent
{
    protected string $componentView = 'components.charts.medicacoes-covid-19';

    public function chartData(): array
    {
        $collection = collect();
        $medicacoes = MedicacoesTratamentoCovidEnum::readables();

        foreach ($medicacoes as $medicacao) {
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    $medicacao,
                    strtolower('%' . $medicacao . '%')
                ]
            ));
        }

        $colletionToChartDataset = new CollectionToChartDatasets(
            'medicacao',
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
            count(total) as total,
            cor_raca,
            medicacao 
        from (
            select
            count(p.id) as total,
            cor_raca,
            recebeu_med_covid,
            CASE
                WHEN recebeu_med_covid is not null THEN ?
            END AS medicacao
            from
            pacientes p
            LEFT JOIN servico_internacaos si ON p.id = si.paciente_id
            where
            cor_raca is not null
            and precisou_servico is not null
            and LOWER(recebeu_med_covid) LIKE ?
            group by
            cor_raca,
            recebeu_med_covid
            order by
            recebeu_med_covid,
            cor_raca
        ) tb
        group by
            cor_raca,
            medicacao 
        ;
    ";
}