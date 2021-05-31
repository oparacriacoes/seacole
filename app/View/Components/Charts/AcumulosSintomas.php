<?php

namespace App\View\Components\Charts;

use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class AcumulosSintomas extends ChartComponent
{
    protected string $componentView = 'components.charts.acumulos-sintomas';

    public function chartData(): array
    {
        $collection = collect(DB::select($this->query));

        $colletionToChartDataset = new CollectionToChartDatasets(
            'total_sintomas',
            'sintomas_iniciais',
            'total',
            $collection
        );

        return [
            'labels' => $colletionToChartDataset->getLabels(),
            'datasets' => $colletionToChartDataset->getDatasets()
        ];
    }

    private $query = "
        select
            count(p.id) as total,
            sintomas_iniciais,
            CONCAT(CHAR_LENGTH(sintomas_atuais) - CHAR_LENGTH(REPLACE(sintomas_atuais, ',', '')) + 1, ' Sintomas') AS total_sintomas
        from
            pacientes p
            INNER JOIN monitoramentos es ON es.paciente_id = p.id
        where
            sintomas_iniciais is not null
            and sintomas_atuais is not null
        group by
            total_sintomas,
            sintomas_iniciais
        order by
            sintomas_iniciais asc,
            total_sintomas
        ;
    ";
}
