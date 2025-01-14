<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class TratamentoPrescritoMedicoProjeto extends ChartComponent
{
    protected string $componentView = 'components.charts.tratamento-prescrito-medico-projeto';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        $colletionToChartDataset = new CollectionToChartDatasets(
            'tratamento_prescrito',
            'cor_raca',
            'total',
            $collection
        );

        return [
            'labels' => array_map('titleLabel', array_values(array_unique(join_colors_to_black($collection)))),
            'sublabels' => $colletionToChartDataset->getLabels(),
            'datasets' => stack_black_colors($colletionToChartDataset->getDatasets())
        ];
    }

    private $query = "
        select
            count(p.id) as total,
            CASE
                WHEN io.tratamento_prescrito is null then null
                WHEN io.tratamento_prescrito is true then 'Sim'
                WHEN io.tratamento_prescrito is false then 'Não'
            END as tratamento_prescrito,
            CASE
                WHEN cor_raca is null then 'sem informação'
                ELSE cor_raca
            END as cor_raca
        from
            pacientes p
            LEFT JOIN insumos_oferecidos io ON io.paciente_id = p.id
        group by
            tratamento_prescrito,
            cor_raca
        order by
            tratamento_prescrito desc,
            cor_raca;
    ";
}
