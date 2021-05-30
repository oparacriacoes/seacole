<?php

namespace App\View\Components\Charts;

use App\Enums\ServicosSaudeEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class ProblemaServicoReferenciaRacaCor extends ChartComponent
{
    protected string $componentView = 'components.charts.problema-servico-referencia-raca-cor';

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
            'servico',
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
            teve_algum_problema as teve_algum_problema,
            CASE
            WHEN teve_algum_problema is not null THEN ?
            END AS servico
        from
            pacientes p
            LEFT JOIN servico_internacaos si ON p.id = si.paciente_id
        where
            cor_raca is not null
            and teve_algum_problema is not null
            and LOWER(teve_algum_problema) LIKE ?
        group by
            cor_raca,
            teve_algum_problema
        order by
            teve_algum_problema,
            cor_raca;
            ";
}
