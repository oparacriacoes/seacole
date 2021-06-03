<?php

namespace App\View\Components\Charts;

use App\Enums\SintomasManifestadosEnum;
use App\Helpers\CollectionToChartDatasets;
use Illuminate\Support\Facades\DB;

class SintomasManifestadosPorDiagnostico extends ChartComponent
{
    protected string $componentView = 'components.charts.sintomas-manifestados-por-diagnostico';

    public function chartData(): array
    {
        $collection = collect();
        $filters = array_slice(SintomasManifestadosEnum::readables(), 8, 4, true);

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
            sintomas_iniciais as info
        from
            (
            select
                p.id,
                ? as sintoma,
                qa.sintomas_manifestados,
                p.sintomas_iniciais
            from
                pacientes p
                inner join quadro_atual qa on qa.paciente_id = p.id
            where
                lower(qa.sintomas_manifestados) like ?
            ) as tb
        group by
            sintoma,
            sintomas_iniciais
        order by
            sintomas_iniciais,
            sintoma;
            ";
}
