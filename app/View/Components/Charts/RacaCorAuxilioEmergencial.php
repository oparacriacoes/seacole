<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class RacaCorAuxilioEmergencial extends ChartComponent
{
    protected string $componentView = 'components.charts.raca-cor-auxilio-emergencial';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));
        $colletionToChartDataset = new CollectionToChartDatasets(
            'auxilio_emergencial',
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
            count(id) as total,
            CASE
                WHEN auxilio_emergencial is null then null
                WHEN auxilio_emergencial is true then 'Sim'
                WHEN auxilio_emergencial is false then 'Não'
                ELSE auxilio_emergencial
            END as auxilio_emergencial,
            CASE 
                WHEN cor_raca is null then 'Sem Informação'
                ELSE cor_raca
            END as cor_raca
        from pacientes
        group by auxilio_emergencial, cor_raca
        order by auxilio_emergencial desc, cor_raca;
    ";
}
