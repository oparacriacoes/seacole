<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class VacinacaoVacina extends ChartComponent
{
    protected string $componentView = 'components.charts.vacinacao-vacina';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

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

    private $query = "
        select
            count(v.id) as total,
            p.cor_raca,
            vac.name as info
        from
            vacinacoes v
            join pacientes p on p.id = v.paciente_id
            join vacinas vac on vac.id = v.vacina_id
        where
            v.dose = 1
        group by
            p.cor_raca,
            vac.name
        order by
            vac.name,
            p.cor_raca;
        ";
}
