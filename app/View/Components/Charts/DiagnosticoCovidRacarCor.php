<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class DiagnosticoCovidRacarCor extends ChartComponent
{
    protected string $componentView = 'components.charts.diagnostico-covid-racar-cor';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));
        $colletionToChartDataset = new CollectionToChartDatasets(
            'sintomas_iniciais',
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
            sintomas_iniciais
        from
            pacientes p
        where
            sintomas_iniciais is not null
            and cor_raca is not null
        group by
            cor_raca,
            sintomas_iniciais
        order by
            sintomas_iniciais desc,
            cor_raca;
    ";
}
