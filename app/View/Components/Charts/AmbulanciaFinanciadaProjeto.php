<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class AmbulanciaFinanciadaProjeto extends ChartComponent
{
    protected string $componentView = 'components.charts.ambulancia-financiada-projeto';

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

    private $query = '
        select
            count(p.id) as total,
            cor_raca,
            if (precisou_ambulancia=true, "Sim", "Não") as info
        from
            pacientes p
            LEFT JOIN servico_internacaos si ON p.id = si.paciente_id
        where
            cor_raca is not null
            and precisou_ambulancia is not null
        group by
            precisou_ambulancia,
            cor_raca
        order by
            precisou_ambulancia desc,
            cor_raca;
    ';
}
