<?php

namespace App\View\Components\Charts;

use App\Enums\ServicosSaudeEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class DeslocamentoServicoSaude extends ChartComponent
{
    protected string $componentView = 'components.charts.deslocamento-servico-saude';

    public function chartData(): array
    {
        $collection = collect();
        $servicos_saude = ServicosSaudeEnum::values();

        foreach ($servicos_saude as $servico_saude) {            
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    $servico_saude,
                    strtolower('%' . $servico_saude . '%')
                ]
            ));
        }

        $colletionToChartDataset = new CollectionToChartDatasets(
            'servico_saude',
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
            servico_saude
        from (
            select
                count(p.id) as total,
                cor_raca,
                precisou_servico,
                CASE
                WHEN precisou_servico is not null THEN ?
                END AS servico_saude
            from
                pacientes p
                LEFT JOIN servico_internacaos si ON p.id = si.paciente_id
            where
                cor_raca is not null
                and LOWER(precisou_servico) LIKE ?
            group by
                cor_raca,
                precisou_servico
            order by
                precisou_servico,
                cor_raca
            ) as tb
        group by
                cor_raca,
                servico_saude
            order by
                servico_saude,
                cor_raca
        ;
        ";
}
