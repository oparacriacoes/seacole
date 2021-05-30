<?php

namespace App\View\Components\Charts;

use App\Enums\SintomasManifestadosEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class SintomasManifestadosPorSituacao2 extends ChartComponent
{
    protected string $componentView = 'components.charts.sintomas-manifestados-por-situacao2';

    public function chartData(): array
    {
        $collection = collect();
        $filters = array_slice(SintomasManifestadosEnum::readables(), 4, 4, true);

        foreach ($filters as $key => $values) {
            $collection = $collection->merge(DB::select(
                $this->query,
                [
                    $values,
                    strtolower('%' . $key . '%')
                ]
            ));
        }

        $colletionToChartDataset = new CollectionToChartDatasets(
            'sintoma',
            'info',
            'total',
            $collection
        );

        return [
            'labels' => $colletionToChartDataset->getLabels(),
            'sublabels' => $colletionToChartDataset->getLabels(),
            'datasets' => $colletionToChartDataset->getDatasets()
        ];
    }

    private $query = "
        select
            count(id) as total,
            sintoma,
            info
        from
            (
            select
                p.id,
                ? as sintoma,
                qa.sintomas_manifestados,
                CASE
                WHEN p.situacao in ('1', '6', '10') THEN 'GRAVE'
                WHEN p.situacao in ('2', '7', '11') THEN 'LEVE'
                END as info
            from
                pacientes p
                inner join quadro_atual qa on qa.paciente_id = p.id
            where
                lower(qa.sintomas_manifestados) like ?
                and p.situacao in ('1', '10', '6', '2', '11', '7')
            ) as tb
        group by
            sintoma,
            info
        order by
            info desc,
            sintoma;
            ";
}
