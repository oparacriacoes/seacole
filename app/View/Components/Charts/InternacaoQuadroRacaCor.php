<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class InternacaoQuadroRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.internacao-quadro-raca-cor';

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

    private $query_1 = '
        select
            count(p.id) as total,
            cor_raca,
            CASE 
                WHEN precisou_ambulancia is true THEN "Precisou de Ambulância"
                ELSE "Não Precisou Ambulância"
            END AS info
        from
            pacientes p
            LEFT JOIN servico_internacaos si ON p.id = si.paciente_id
        where
            cor_raca is not null
            and precisou_ambulancia is not null
        group by
            cor_raca,
            precisou_ambulancia
        order by
            precisou_ambulancia,
            cor_raca;
    ';

    private $query_2 = '
        select
            count(p.id) as total,
            cor_raca,
            CASE 
                WHEN precisou_internacao is true THEN "Internação pelo quadro (suspeito ou confirmado)"
            END AS info
        from
            pacientes p
            LEFT JOIN servico_internacaos si ON p.id = si.paciente_id
        where
            cor_raca is not null
            AND precisou_internacao is true
            AND (sintomas_iniciais = "Suspeito" OR sintomas_iniciais = "Confirmado")
        group by
            cor_raca,
            precisou_internacao
        order by
            precisou_internacao,
            cor_raca;
    ';
}
